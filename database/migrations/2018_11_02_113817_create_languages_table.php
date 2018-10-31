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
            $table->charset = 'utf8';
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
    }
}
