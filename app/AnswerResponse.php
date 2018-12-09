<?php

namespace App;
use App\Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Answer;

class AnswerResponse extends BaseModel {

    protected $table = 'answer_responses';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'exam_response_id',
        'answer_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
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

    public function examResponse() {
        return $this->belongsTo('App\ExamResponse','exam_response_id','id');
    }

    public function answer() {
        return $this->belongsTo('App\Answer','answer_id','id');
    }

    //protected $connection = 'local';
}
