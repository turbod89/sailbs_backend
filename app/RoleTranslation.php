<?php

namespace App;
use App\Helpers;

class RoleTranslation extends BaseModel {

    public $timestamps = false;
    protected $fillable = ['name','short_name','description'];

}
