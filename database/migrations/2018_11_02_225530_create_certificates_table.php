<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('certificates');
        Schema::create('certificates', function (Blueprint $table) {
            // $table->charset = 'utf8';
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('code',16)->nullable(false);

            $table->boolean('deleted')->default(false);
            $table->dateTime('created_at')->default(DB::raw('NOW()'));
            $table->dateTime('updated_at')->default(DB::raw('NOW()'));
            $table->dateTime('deleted_at')->nullable(true);

            $table->index('code');
            $table->unique('code');
        });

        Schema::dropIfExists('certificate_translations');
        Schema::create('certificate_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('certificate_id')->unsigned();
            $table->string('name');
            $table->string('short_name');
            $table->text('description');
            $table->string('locale')->index();

            $table->unique(['certificate_id','locale']);
            $table->foreign('certificate_id')->references('id')->on('certificates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certificates', function (Blueprint $table) {
            //
        });
        Schema::dropIfExists('certificates');
        Schema::dropIfExists('certificate_translations');
    }
}
