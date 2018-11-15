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
    protected $fillable = [];

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

    public function doneUsers() {
        return $this->belongsToMany('App\Users','exam_responses','user_id','exam_id')
            ->as('users_pivot')
            ->withPivot('certificate_id','started_at','finished_at','corrected_at')
            ->withTimestamps();
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
                sum(if(er.id is null, 0, 1)) as isDone,
                exam_id
            from
                exams e
            left join
                exam_responses er on er.user_id = ? and er.exam_id = e.id
            group by
                exam_id
            having
                isDone = 0
        ";

        $exam_response_rows = DB::select($query,[$user->id]);

        error_log(print_r($exam_response_rows,true));

        if (empty($exam_response_rows)) {
            return self::generate($certificate);
        }

        $exam_id = $exam_response_rows[0]->exam_id;

        return self::get($exam_id);
    }

    /**
     * Generates a new exam
     *
     * @param Certificate $certificate
     * @return Exam
     */

    public static function generate(Certificate $certificate) {

        // create exam

        $names = [];

        foreach (ExamTranslation::$defaultLocales as $locale) {
            $localeNames = [];
            $localeNames['name'] = ExamTranslation::generateName($certificate,$locale);
            $localeNames['short_name'] = ExamTranslation::generateShortName($certificate,$locale);
            $localeNames['description'] = ExamTranslation::generateDescription($certificate,$locale);
            $names[$locale] = $localeNames;
        }
        $exam = self::create($names);

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

    public function toArray() {
        $json = parent::toArray();

        $json['questions'] = $this->questions()->orderBy('position','asc')->get()->toArray();

        return $json;
    }

    //protected $connection = 'local';
}
