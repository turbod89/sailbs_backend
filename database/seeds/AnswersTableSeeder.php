<?php

use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{

    const ANSWER_PER_QUESTION = 4;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $questions = \App\Question::all();

        foreach($questions as $question) {
            $correct_num = random_int(0, self::ANSWER_PER_QUESTION -1);
            for ($i = 0; $i < self::ANSWER_PER_QUESTION; $i++) {
                $uuid = \Webpatser\Uuid\Uuid::generate();
                $answer = new \App\Answer();
                $answer->uuid = $uuid;
                $answer->position = $i;
                $answer->correct = $i === $correct_num;
                $answer->save();
                self::setNames($question,$answer,$i);
            }
        }

    }


    public function setNames(\App\Question $question, \App\Answer $answer, $index) {

        $number = $index + 1;

        $correct_text = $answer->correct ? 'correcta' : 'incorrecta';
        \App\AnswerTranslation::updateOrCreate(
            ['locale' => 'es', 'answer_id' => $answer->id],
            [
                'statement' => "Respuesta $correct_text a la pregunta '{$question->statement}' número $number."
            ]
        );


        $correct_text = $answer->correct ? 'Correct' : 'Wrong';
        $question_statement_en = !empty($question->translate('en')) ? $question->translate('en')->statement : $question->id;
        \App\AnswerTranslation::updateOrCreate(
            ['locale' => 'en', 'answer_id' => $answer->id],
            [
                'statement' => "$correct_text answer to question '{$question_statement_en}' number $number."
            ]
        );

    }

}
