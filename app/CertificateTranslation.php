<?php

namespace App;
use App\Helpers;

class CertificateTranslation extends BaseModel {

    public $timestamps = false;
    protected $fillable = ['name','short_name','description'];

}
