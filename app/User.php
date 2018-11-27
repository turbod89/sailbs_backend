<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends BaseModel implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $table = 'users';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'hashed_password',
    ];

    public function setPasswordAttribute($password) {
        $this->attributes['hashed_password'] = md5($password);
    }

    public function certificates() {
        return $this->belongsToMany('App\Certificate','users_roles_certificates','user_id','certificate_id')->as('subscription')->withTimestamps();
    }

    public function examResponses() {
        return $this->hasMany('App\ExamResponse','user_id','id');
    }

}
