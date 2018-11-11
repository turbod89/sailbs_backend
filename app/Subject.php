<?php

namespace App;
use App\Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Subject extends BaseModel {

    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name','short_name','description'];

    private static $lang = null;

    protected $table = 'subjects';
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

    public function certificates() {
        return $this->belongsToMany('App\Certificate','certificates_subjects','subject_id','certificate_id')->as('certificates');
    }

    public function questions() {
        return $this->hasMany('App\Questions','subject_id','id');
    }

    public function toArray()
    {
        $json = parent::toArray();

        $json['certificates'] = [];
        foreach ($this->certificates as $certificate) {
            $json['certificates'][] = [
                'id' => $certificate->id,
                'code' => $certificate->code,
            ];
        }

        return $json;
    }

    //protected $connection = 'local';
}
