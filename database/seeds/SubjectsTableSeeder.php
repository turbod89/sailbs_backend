<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    const NUM_SUBJECTS_PER_CERTIFICATE = 5;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $certificates = \App\Certificate::get()->all();

        $index = 1;
        foreach ($certificates as $certificate) {
            for ($i = 0; $i < self::NUM_SUBJECTS_PER_CERTIFICATE; $i++) {
                $code = "SBJ{$index}";
                $subject = \App\Subject::updateOrCreate(['code' => $code]);
                \App\SubjectTranslation::updateOrCreate(
                    ['locale' => 'es', 'subject_id' => $subject->id],
                    [
                        'name' => "Asignatura {$index}",
                        'short_name' => "As {$index}",
                        'description' => "Asignatura numero {$index}."
                    ]
                );
                \App\SubjectTranslation::updateOrCreate(
                    ['locale' => 'en', 'subject_id' => $subject->id],
                    [
                        'name' => "Subject {$index}",
                        'short_name' => "Sbj {$index}",
                        'description' => "Subject number {$index}."
                    ]
                );
                $num_questions = random_int(3,5);
                $max_errors = min($num_questions,random_int(1,2*$num_questions));
                $subject->certificates()->syncWithoutDetaching([
                    $certificate->id => [
                        'max_errors' => $max_errors,
                        'num_questions' => $num_questions,
                    ],

                ]);

                $index++;

            }
        }

        /*
        \App\Subject::updateOrCreate([ 'code' => 'NavegacionPER']);
        \App\Subject::updateOrCreate([ 'code' => 'NomenclaturaPNBPER']);

        self::setNames();
        self::setRelationCertificates();
        */
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
        \App\SubjectTranslation::updateOrCreate(
            ['locale' => 'en', 'subject_id' => $subject->id],
            [
                'name' => 'Nomenclature',
                'short_name' => 'Nomenclature',
                'description' => 'Nomenclatura subject.'
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
