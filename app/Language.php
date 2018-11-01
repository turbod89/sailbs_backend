<?php

namespace App;
use App\Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Language extends BaseModel {

    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name'];

    private static $lang = null;

    protected $table = 'languages';
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

    public static function get($code = null) {

        if (!is_null($code)) {
            return self::where(['iso_code' => $code])->first();
        }

        if (is_null(self::$lang)) {
            self::$lang = self::where(['iso_code' => app('translator')->getLocale()])->first();
        }

        return self::$lang;
    }

    public static function set($code = null) {

        if (!is_null($code)) {
            self::$lang = self::where(['iso_code' => $code])->first();
            app('translator')->setLocale(self::$lang->isoCode);
        }

        return self::get();
    }

    //protected $connection = 'local';
}
