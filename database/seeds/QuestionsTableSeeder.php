<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = \App\Subject::all();


    }


    public function setNames() {

        $subject = \App\Subject::where(['code' => 'NavegacionPER'])->first();
        \App\SubjectTranslation::updateOrCreate(
            ['locale' => 'es', 'subject_id' => $subject->id],
            [
                'name' => 'Navegación',
                'short_name' => 'Navegación',
                'description' => 'Asignatura de navegación.'
            ]
        );
        \App\SubjectTranslation::updateOrCreate(
            ['locale' => 'en', 'subject_id' => $subject->id],
            [
                'name' => 'Navigation',
                'short_name' => 'Navigation',
                'description' => 'Navigation subject'
            ]
        );

        $subject = \App\Subject::where(['code' => 'NomenclaturaPNBPER'])->first();
        \App\SubjectTranslation::updateOrCreate(
            ['locale' => 'es', 'subject_id' => $subject->id],
            [
                'name' => 'Nomenclatura',
                'short_name' => 'Nomenclatura',
                'description' => 'Asignatura de nomenclatura.'
            ]
        );

    }

    public function setRelationCertificates() {

        $PNB = \App\Certificate::where(['code' => 'PNB'])->first();
        $PER = \App\Certificate::where(['code' => 'PER'])->first();

        $subject = \App\Subject::where(['code' => 'NavegacionPER'])->first();
        $subject->certificates()->syncWithoutDetaching([
            $PER->id => [
                'max_errors' => 3,
                'num_questions' => 4,
            ],

        ]);


        $subject = \App\Subject::where(['code' => 'NomenclaturaPNBPER'])->first();
        $subject->certificates()->syncWithoutDetaching([
            $PNB->id => [
                'max_errors' => 2,
                'num_questions' => 3,
            ],

            $PER->id => [
                'max_errors' => 1,
                'num_questions' => 5,
            ],

        ]);
    }
}
