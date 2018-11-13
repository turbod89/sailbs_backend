<?php

use Illuminate\Database\Seeder;

class TestsTableSeeder extends Seeder
{

    const TESTS_PER_CERTIFICATE = 3;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $certificates = \App\Certificate::all();

        foreach ($certificates as $certificate) {
            \App\Test::generate($certificate);
        }
    }

}
