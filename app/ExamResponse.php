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

    public function certificate() {
        return $this->belongsTo('App\Certificate','certificate_id','id');
    }

    //protected $connection = 'local';
}
