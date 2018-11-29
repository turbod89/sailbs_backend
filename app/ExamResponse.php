<?php

namespace App;
use App\Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Answer;

class ExamResponse extends BaseModel {

    // not needed... by now
    // use \Dimsav\Translatable\Translatable;

    // public $translatedAttributes = ['statement'];

    protected $table = 'exam_responses';
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
        // 'translations'
    ];

    protected $dates = [
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT,

        'started_at',
        'finished_at',
        'corrected_at',
    ];


    /**
     * Map between object members and table fields
     *
     * @var array
     */
    protected $maps = [
    ];

    public function exam() {
        return $this->belongsTo('App\Exam','exam_id','id');
    }

    public function user() {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function answer_responses() {
        return $this->hasMany('App\AnswerResponse','exam_response_id','id');
    }

    public function answers() {
        return $this->hasManyThrough('App\Answer','App\AnswerResponse','exam_response_id','id','id','answer_response_id');
    }

    public function getSubjectSummaryAttribute() {
        $query = "
            select
                asked.subject_id as subject_id,
                asked.num_questions as num_questions,
                convert(ifnull(answered.num_answered,0), unsigned integer) as num_answered,
                convert(ifnull(answered.num_correct,0), unsigned integer) as num_correct,
                convert(asked.num_questions - ifnull(answered.num_correct,0), unsigned integer) as num_errors,
                asked.max_errors as max_errors,
                case
                    when max_errors is null then 1
                    when max_errors >= asked.num_questions - ifnull(answered.num_correct,0) then 1
                    else 0
                end as subject_passed
                
            from 
                (
                    select
                        s.id as subject_id,
                        cs.num_questions as num_questions,
                        cs.max_errors as max_errors
                    from exam_responses er
                    inner join exams e on er.id = ? and e.id = er.exam_id
                    inner join questions_exams qe on qe.exam_id = e.id
                    inner join questions q on q.id = qe.question_id
                    inner join subjects s on s.id = q.subject_id
                    inner join certificates_subjects cs on cs.subject_id = s.id and cs.certificate_id = e.certificate_id
                    group by
                        s.id
                ) as asked
            
            left join
                (
                    select
                        s.id as subject_id,
                        sum( if (a.correct = 1, 1, 0)) as num_correct,
                        sum( if (ar.id is null, 0, 1)) as num_answered
                    from exam_responses er
                    inner join answer_responses ar on er.id = ? and ar.exam_response_id = er.id
                    inner join answers a on a.id = ar.answer_id
                    inner join questions q on q.id = a.question_id
                    inner join subjects s on s.id = q.subject_id
                    group by
                        s.id
                ) as answered
            on asked.subject_id = answered.subject_id
        ";

        $summary = DB::select($query,[$this->id,$this->id]);

        return $summary;
    }

    public function getSummaryAttribute() {

        $query = "
            select
                asked.exam_response_id as exam_response_id,
                asked.num_questions as num_questions,
                convert(ifnull(answered.num_answered,0), unsigned integer) as num_answered,
                convert(ifnull(answered.num_correct,0) , unsigned integer) as num_correct,
                convert(asked.num_questions - ifnull(answered.num_correct,0), unsigned integer) as num_errors,
                asked.max_errors as max_errors,
                case
                    when max_errors is null then 1
                    when max_errors >= asked.num_questions - ifnull(answered.num_correct,0) then 1
                    else 0
                end as exam_passed
                
            from 
                (
                    select
                        er.id as exam_response_id,
                        count(*) as num_questions,
                        99999 as max_errors -- num to change
                    from exam_responses er
                    inner join exams e on er.id = ? and e.id = er.exam_id
                    inner join questions_exams qe on qe.exam_id = e.id
                    inner join questions q on q.id = qe.question_id
                    group by
                        er.id
                ) as asked
            
            left join
                (
                    select
                        er.id as exam_response_id,
                        sum( if (a.correct = 1, 1, 0)) as num_correct,
                        sum( if (ar.id is null, 0, 1)) as num_answered
                    from exam_responses er
                    inner join answer_responses ar on er.id = ? and ar.exam_response_id = er.id
                    inner join answers a on a.id = ar.answer_id
                    group by
                        er.id
                ) as answered
            on asked.exam_response_id = answered.exam_response_id
        ";

        $summary = DB::select($query,[$this->id,$this->id]);

        return $summary[0];
    }

    public function getIsPassedAttribute() {
        $summary = $this->summary;
        $subjectSummary = $this->subject_summary;

        forEach ($subjectSummary as $subjectSummaryRow) {
            if ( $subjectSummaryRow->subject_passed == 0) {
                return false;
            }
        }

        return $summary->exam_passed;
    }

    public function toArray()
    {
        $json = parent::toArray();

        unset($json['exam']);
        unset($json['user']);

        $json['exam_id'] = $this->exam->id;
        $json['user_id'] = $this->user->id;
        $json['certificate_code'] = $this->exam->certificate->code;
        $json['summary'] = $this->summary;
        $json['subject_summary'] = $this->subject_summary;

        return $json;
    }

    //protected $connection = 'local';
}
