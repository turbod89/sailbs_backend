<?php

namespace App;
use App\Helpers;

class SubjectTranslation extends BaseModel {

    public $timestamps = false;
    protected $fillable = ['name','short_name','description'];

}
