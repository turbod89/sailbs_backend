<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('languages');
        Schema::create('languages', function (Blueprint $table) {
            // $table->charset = 'utf8';
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('iso_code',2)->nullable(false);
            $table->string('language_code',5)->nullable(false);
            $table->string('date_format_lite',32)->nullable(false)->default('Y-m-d');
            $table->string('date_format_full',32)->nullable(false)->default('Y-m-d H:i:s');

            $table->boolean('deleted')->default(false);
            $table->dateTime('created_at')->default(DB::raw('NOW()'));
            $table->dateTime('updated_at')->default(DB::raw('NOW()'));
            $table->dateTime('deleted_at')->nullable(true);

            $table->unique('iso_code');
            $table->unique('language_code');
        });

        Schema::dropIfExists('language_translations');
        Schema::create('language_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('language_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();

            $table->unique(['language_id','locale']);
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('languages', function (Blueprint $table) {
            //
        });
        Schema::dropIfExists('languages');
        Schema::dropIfExists('language_translations');
    }
}
