<?php

use Illuminate\Database\Seeder;

class ExamsTableSeeder extends Seeder
{

    const EXAMS_PER_CERTIFICATE = 3;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $certificates = \App\Certificate::all();

        foreach ($certificates as $certificate) {
            for ($i = 0; $i < self::EXAMS_PER_CERTIFICATE; $i++) {
                \App\Exam::generate($certificate);
            }
        }
    }

}
