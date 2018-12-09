<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Language::updateOrCreate([
            'iso_code' => 'en'
        ],[
            'language_code' => 'en-us',
            'date_format_lite' => 'm/j/Y',
            'date_format_full' => 'm/j/Y H:i:s',
        ]);

        \App\Language::updateOrCreate([
            'iso_code' => 'fr',
        ],[
            'language_code' => 'fr',
            'date_format_lite' => 'd/m/Y',
            'date_format_full' => 'd/m/Y H:i:s',
        ]);

        \App\Language::updateOrCreate([
            'iso_code' => 'es',
        ],[
            'language_code' => 'es',
            'date_format_lite' => 'Y-m-d',
            'date_format_full' => 'Y-m-d H:i:s',
        ]);


        self::setNames();

    }


    public function setNames() {
        $language = \App\Language::where(['iso_code' => 'en'])->first();
        \App\LanguageTranslation::updateOrCreate([
            'language_id' => $language->id,
            'locale' => 'en'
            ],[
                'name' => 'English',
        ]);
        \App\LanguageTranslation::updateOrCreate([
            'language_id' => $language->id,
            'locale' => 'es'
        ],[
            'name' => 'Inglés',
        ]);

        $language = \App\Language::where(['iso_code' => 'fr'])->first();
        \App\LanguageTranslation::updateOrCreate([
            'language_id' => $language->id,
            'locale' => 'en'
        ],[
            'name' => 'French',
        ]);
        \App\LanguageTranslation::updateOrCreate([
            'language_id' => $language->id,
            'locale' => 'es'
        ],[
            'name' => 'Francés',
        ]);


        $language = \App\Language::where(['iso_code' => 'es'])->first();
        \App\LanguageTranslation::updateOrCreate([
            'language_id' => $language->id,
            'locale' => 'en'
        ],[
            'name' => 'Spanish',
        ]);
        \App\LanguageTranslation::updateOrCreate([
            'language_id' => $language->id,
            'locale' => 'es'
        ],[
            'name' => 'Español',
        ]);
    }
}
