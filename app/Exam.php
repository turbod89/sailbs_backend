<?php

namespace App;
use App\Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Exam extends BaseModel {

    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name','short_name','description'];

    private static $lang = null;

    protected $table = 'exams';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'certificate_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'translations'
    ];

    protected $dates = [
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT,
    ];


    /**
     * Map between object members and table fields
     *
     * @var array
     */
    protected $maps = [
    ];

    public function questions() {
        return $this->belongsToMany('App\Question','questions_exams','exam_id','question_id');
    }

    public function answers() {

        return DB::table('answers')
            ->join('questions','questions.id','=','answers.question_id')
            ->join('questions_exams', function ($join) {
                $join->on('questions_exams.question_id','=','questions.id');
                $join->where('questions_exams.exam_id','=',$this->id);
            })
            ->select('answers.*');

    }

    public function doneUsers() {
        return $this->belongsToMany('App\Users','exam_responses','user_id','exam_id')
            ->as('users_pivot')
            ->withPivot('certificate_id','started_at','finished_at','corrected_at')
            ->withTimestamps();
    }

    public function certificate() {
        return $this->belongsTo('App\Certificate','certificate_id','id');
    }


    /**
     * Check if exists an exam not done for this user about this certificate
     * if exists, it's returns
     * else create new and returns
     *
     * @param User $user
     * @param Certificate $certificate
     * @return Exam
     */

    public static function getUndoneExam(User $user, Certificate $certificate) {
        $query = "
            select
                sum(if(er.user_id = ? , 1, 0)) as times_done_by_user,
                sum(1) as times_done_by_all_users,
                e.id as exam_id
            from
                exams e
            left join
                exam_responses er on er.exam_id = e.id
            where
                e.certificate_id = ?
            group by
                e.id
            having
                times_done_by_user = 0
        ";



        $exam_response_rows = DB::select($query,[$user->id, $certificate->id]);

        // error_log(print_r($exam_response_rows,true));

        if (empty($exam_response_rows)) {
            return self::generate($certificate);
        }

        shuffle($exam_response_rows);
        $exam_id = $exam_response_rows[0]->exam_id;

        return self::find($exam_id);
    }

    /**
     * Generates a new exam
     *
     * @param Certificate $certificate
     * @return Exam
     */

    public static function generate(Certificate $certificate) {

        // create exam

        $init = [
            'certificate_id' => $certificate->id,
        ];

        foreach (ExamTranslation::$defaultLocales as $locale) {
            $localeNames = [];
            $localeNames['name'] = ExamTranslation::generateName($certificate,$locale);
            $localeNames['short_name'] = ExamTranslation::generateShortName($certificate,$locale);
            $localeNames['description'] = ExamTranslation::generateDescription($certificate,$locale);
            $init[$locale] = $localeNames;
        }
        $exam = self::create($init);
        $exam->save();

        // choose questions
        $subjects = $certificate->subjects;

        $question_cnt = 0;
        foreach ($subjects as $subject) {

            $selectedQuestions = Question::where([['subject_id',$subject->id]])
                ->inRandomOrder($subject->num_questions)
                ->limit($subject->subjects_pivot->num_questions)
                ->get();

            $relations = [];
            foreach ($selectedQuestions as $question) {
                $relations[$question->id] = ['position' => $question_cnt];
                $question_cnt++;
            }

            $exam->questions()->attach($relations);

        }

        return $exam;

    }

    /**
     * @param Exam $exam
     * @param User $user
     * @param array $response
     * @return ExamResponse
     */
    public static function correct(Exam $exam, User $user, $response) {

        $examResponse = new ExamResponse();
        $examResponse->finished_at = Carbon::now();
        $examResponse->exam()->associate($exam);
        $examResponse->user()->associate($user);
        $examResponse->save();

        forEach ($response as $answer_response) {
            $answer_uuid = isset ($answer_response['answer_uuid']) ? $answer_response['answer_uuid'] : null;
            $answer_data = $exam->answers()->where('answers.uuid', $answer_uuid)->first();

            if (!empty($answer_data)) {
                $answer_response = new AnswerResponse([
                    'answer_id' => $answer_data->id,
                    'exam_response_id' => $examResponse->id,
                ]);
                $answer_response->save();
            }

        }

        $examResponse->corrected_at = Carbon::now();
        $examResponse->save();
        return $examResponse;


    }

    public function toArray() {
        $json = parent::toArray();

        $json['questions'] = $this->questions()->orderBy('position','asc')->get()->toArray();

        return $json;
    }

    //protected $connection = 'local';
}
