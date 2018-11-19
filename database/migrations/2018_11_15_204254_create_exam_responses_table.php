<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('exam_responses');
        Schema::create('exam_responses', function (Blueprint $table) {
            // $table->charset = 'utf8';
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->dateTime('started_at')->default(null);
            $table->dateTime('finished_at')->default(null);
            $table->dateTime('corrected_at')->default(null);

            $table->integer('user_id')->unsigned();
            $table->integer('exam_id')->unsigned();
            // $table->integer('certificate_id')->unsigned();

            $table->boolean('deleted')->default(false);
            $table->dateTime('created_at')->default(DB::raw('NOW()'));
            $table->dateTime('updated_at')->default(DB::raw('NOW()'));
            $table->dateTime('deleted_at')->nullable(true);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
            // $table->foreign('certificate_id')->references('id')->on('exams')->onDelete('cascade');
        });

        Schema::dropIfExists('exam_response_translations');

        // not needed... by now
        /*
        Schema::create('exam_response_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('exam_id')->unsigned();
            $table->string('name');
            $table->string('short_name');
            $table->text('description');
            $table->string('locale')->index();

            $table->unique(['exam_id','locale']);
            $table->foreign('exam_id')->references('id')->on('exam_responses')->onDelete('cascade');
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_responses', function (Blueprint $table) {
            //
        });
        Schema::dropIfExists('exam_responses');
        // Schema::dropIfExists('exam_response_translations');
    }
}
