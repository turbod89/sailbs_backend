<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            // $table->collation = 'utf8_unicode_ci';
            // $table->charset = 'utf8';
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('username',32)->nullable(false);
            $table->string('email',128)->nullable(false);
            $table->string('hashed_password',128)->nullable(false);

            $table->string('first_name',32)->nullable(true);
            $table->string('last_name',32)->nullable(true);

            $table->integer('role_id')->unsigned()->nullable(true);

            $table->boolean('deleted')->default(false);
            $table->dateTime('created_at')->default(DB::raw('NOW()'));
            $table->dateTime('updated_at')->default(DB::raw('NOW()'));
            $table->dateTime('deleted_at')->nullable(true);

            $table->unique('email', 'email');
            $table->unique('username', 'username');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
        Schema::dropIfExists('users');
    }
}
