<?php

namespace App;
use App\Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Certificate extends BaseModel {

    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name','short_name','description'];

    private static $lang = null;

    protected $table = 'certificates';
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

    //protected $connection = 'local';
}
