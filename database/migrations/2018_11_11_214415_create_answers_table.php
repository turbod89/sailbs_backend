<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('answers');
        Schema::create('answers', function (Blueprint $table) {
            // $table->charset = 'utf8';
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->uuid('uuid')->nullable(false);
            $table->integer('question_id')->unsigned()->nullable(false);
            $table->integer('position')->nullable(false)->default(0);
            $table->boolean('correct')->nullable(false)->default(false);

            $table->boolean('deleted')->default(false);
            $table->dateTime('created_at')->default(DB::raw('NOW()'));
            $table->dateTime('updated_at')->default(DB::raw('NOW()'));
            $table->dateTime('deleted_at')->nullable(true);

            $table->index('question_id');
            $table->index('uuid');
            $table->unique('uuid');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });

        Schema::dropIfExists('answer_translations');
        Schema::create('answer_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('answer_id')->unsigned();
            $table->text('statement');
            $table->string('locale')->index();

            $table->unique(['answer_id','locale']);
            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answers', function (Blueprint $table) {
            //
        });
        Schema::dropIfExists('answer_translations');
        Schema::dropIfExists('answers');
    }
}
