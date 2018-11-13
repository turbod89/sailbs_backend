<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tests');
        Schema::create('tests', function (Blueprint $table) {
            // $table->charset = 'utf8';
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->boolean('deleted')->default(false);
            $table->dateTime('created_at')->default(DB::raw('NOW()'));
            $table->dateTime('updated_at')->default(DB::raw('NOW()'));
            $table->dateTime('deleted_at')->nullable(true);
        });

        Schema::dropIfExists('test_translations');
        Schema::create('test_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('test_id')->unsigned();
            $table->string('name');
            $table->string('short_name');
            $table->text('description');
            $table->string('locale')->index();

            $table->unique(['test_id','locale']);
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tests', function (Blueprint $table) {
            //
        });
        Schema::dropIfExists('tests');
        Schema::dropIfExists('test_translations');
    }
}
