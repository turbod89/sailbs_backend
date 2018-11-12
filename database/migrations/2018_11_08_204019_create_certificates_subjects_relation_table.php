<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificatesSubjectsRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('certificates_subjects');
        Schema::create('certificates_subjects', function (Blueprint $table) {
            // $table->charset = 'utf8';
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('certificate_id')->references('id')->on('certificates')->onDelete('cascade');
            $table->integer('subject_id')->references('id')->on('subjects')->onDelete('cascade');

            $table->integer('max_errors')->nullable(true);
            $table->integer('num_questions')->nullable(true);


            $table->boolean('deleted')->default(false);
            $table->dateTime('created_at')->default(DB::raw('NOW()'));
            $table->dateTime('updated_at')->default(DB::raw('NOW()'));
            $table->dateTime('deleted_at')->nullable(true);

            $table->unique(['subject_id','certificate_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certificates_subjects', function (Blueprint $table) {
            //
        });
        Schema::dropIfExists('certificates_subjects');
    }
}
