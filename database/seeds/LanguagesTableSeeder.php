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
        DB::table('languages')->insert([
            'iso_code' => 'es',
            'language_code' => 'es',
            'date_format_lite' => 'Y-m-d',
            'date_format_full' => 'Y-m-d H:i:s',
        ]);
    }
}
