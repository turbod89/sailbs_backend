<?php

namespace App;
use App\Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Token extends BaseModel {

    private static $session = null;

    protected $table = 'tokens';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'value',
        'expire_at',
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
        'expire_at',
    ];


    /**
     * Map between object members and table fields
     *
     * @var array
     */
    protected $maps = [
    ];

    public function setUserAttribute(User $user) {
        $this->attributes['user_id'] = $user->id;
    }

    public function setApiAttribute(int $i) {
        $this->attributes['api_id'] = $i;
    }

    public function getApiAttribute() {
        return $this->api_id;
    }

    public function user() {
        return $this->hasOne('App\User','id','user_id');
    }

    public static function session($session = null) {

        if (!is_null($session)) {
            self::$session = $session;
        }

        return is_null(self::$session) ? new Token() : self::$session;
    }

    public static function clean() {
        self::where(DB::raw('expire_at < NOW()'))->delete();
    }

    //protected $connection = 'local';
}
