<?php

namespace App;
use App\Helpers;
use Illuminate\Support\Carbon;

class ExamTranslation extends BaseModel {

    public $timestamps = false;
    protected $fillable = ['name','short_name','description'];

    public static $defaultLocales = ['es','en'];

    public static function generateName(Certificate $certificate, $locale = null) {

        if (empty($locale)) {
            $locale = Language::get();
        }

        if ( $locale === 'es') {
            return "Test aleatorio de {$certificate->translate($locale)->name}.";
        } else if ( $locale === 'en') {
            return "Random test about {$certificate->translate($locale)->name}.";
        }

        return '';
    }

    public static function generateShortName(Certificate $certificate, $locale = null) {

        if (empty($locale)) {
            $locale = Language::get();
        }

        if ( $locale === 'es') {
            return "Test de {$certificate->translate($locale)->short_name}.";
        } else if ( $locale === 'en') {
            return "Test about {$certificate->translate($locale)->short_name}.";
        }

        return '';
    }


    public static function generateDescription(Certificate $certificate, $locale = null) {

        if (empty($locale)) {
            $locale = Language::get();
        }

        if ( $locale === 'es') {
            return "Este es un test de {$certificate->translate($locale)->name} generado automáticamente a fecha ".(Carbon::now()->toDateTimeString()).".";
        } else if ( $locale === 'en') {
            return "This is a random test about {$certificate->translate($locale)->name} generated automatically on date ".(Carbon::now()->toDateTimeString()).".";
        }

        return '';
    }

}
