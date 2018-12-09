<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('answer_responses');
        Schema::create('answer_responses', function (Blueprint $table) {
            // $table->charset = 'utf8';
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->integer('answer_id')->unsigned();
            $table->integer('exam_response_id')->unsigned();

            $table->boolean('deleted')->default(false);
            $table->dateTime('created_at')->default(DB::raw('NOW()'));
            $table->dateTime('updated_at')->default(DB::raw('NOW()'));
            $table->dateTime('deleted_at')->nullable(true);

            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
            $table->foreign('exam_response_id')->references('id')->on('exam_responses')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answer_responses', function (Blueprint $table) {
            //
        });
        Schema::dropIfExists('answer_responses');
    }
}
