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
        $id_counter = 0;

        $id_counter++;
        DB::table('languages')->insert([
            'iso_code' => 'en',
            'language_code' => 'en-us',
            'date_format_lite' => 'm/j/Y',
            'date_format_full' => 'm/j/Y H:i:s',
        ]);

        DB::table('language_translations')->insert([
            'language_id' => $id_counter,
            'name' => 'English',
            'locale' => 'en'
        ]);

        DB::table('language_translations')->insert([
            'language_id' => $id_counter,
            'name' => 'Inglés',
            'locale' => 'es'
        ]);


        $id_counter++;
        DB::table('languages')->insert([
            'iso_code' => 'fr',
            'language_code' => 'fr',
            'date_format_lite' => 'd/m/Y',
            'date_format_full' => 'd/m/Y H:i:s',
        ]);

        DB::table('language_translations')->insert([
            'language_id' => $id_counter,
            'name' => 'French',
            'locale' => 'en'
        ]);

        DB::table('language_translations')->insert([
            'language_id' => $id_counter,
            'name' => 'Francés',
            'locale' => 'es'
        ]);



        $id_counter++;
        DB::table('languages')->insert([
            'iso_code' => 'es',
            'language_code' => 'es',
            'date_format_lite' => 'Y-m-d',
            'date_format_full' => 'Y-m-d H:i:s',
        ]);


        DB::table('language_translations')->insert([
            'language_id' => $id_counter,
            'name' => 'Spanish',
            'locale' => 'en'
        ]);

        DB::table('language_translations')->insert([
            'language_id' => $id_counter,
            'name' => 'Español',
            'locale' => 'es'
        ]);


    }


    public function setNames() {

    }
}
