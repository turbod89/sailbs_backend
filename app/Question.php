<?php

namespace App;
use App\Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Answer;

class Question extends BaseModel {

    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['statement'];

    protected $table = 'questions';
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

    public function subject() {
        return $this->belongsTo('App\Subject','subject_id','id')->as('subject');
    }

    public function answers() {
        return $this->hasMany('App\Answer','question_id','id');
    }

    public function toArray()
    {
        $json = parent::toArray();

        $json['answers'] = $this->answers->toArray();

        return $json;
    }

    //protected $connection = 'local';
}
