<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{

    const QUESTIONS_PER_SUBJECT = 10;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $subjects = \App\Subject::all();

        foreach($subjects as $subject) {
            for ($i = 0; $i < self::QUESTIONS_PER_SUBJECT; $i++) {
                $uuid = \Webpatser\Uuid\Uuid::generate();
                $question = new \App\Question();
                $question->uuid = $uuid;
                $question->subject_id = $subject->id;
                $question->save();
                self::setNames($subject,$question,$i);
            }
        }

    }


    public function setNames(\App\Subject $subject, \App\Question $question, $index) {

        $number = $index + 1;

        \App\QuestionTranslation::updateOrCreate(
            ['locale' => 'es', 'question_id' => $question->id],
            [
                'statement' => "Pregunta de {$subject->name} número $number."
            ]
        );


        $subject_name_en = !empty($subject->translate('en')) ? $subject->translate('en')->name : $subject->code;
        \App\QuestionTranslation::updateOrCreate(
            ['locale' => 'en', 'question_id' => $question->id],
            [
                'statement' => "Question about {$subject_name_en} number $number."
            ]
        );

    }

}
