<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('questions');
        Schema::create('questions', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('subject_id')->unsigned()->references('id')->on('subjects')->onDelete('cascade');

            $table->boolean('deleted')->default(false);
            $table->dateTime('created_at')->default(DB::raw('NOW()'));
            $table->dateTime('updated_at')->default(DB::raw('NOW()'));
            $table->dateTime('deleted_at')->nullable(true);

            $table->index('subject_id');

        });

        Schema::dropIfExists('question_translations');
        Schema::create('question_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->unsigned();
            $table->text('statement');
            $table->string('locale')->index();

            $table->unique(['question_id','locale']);
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            //
        });
        Schema::dropIfExists('questions');
        Schema::dropIfExists('question_translations');
    }
}
