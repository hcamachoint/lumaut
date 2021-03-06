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
       Schema::create('users', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name', 256);
          $table->string('email', 64)->unique();
          $table->string('password', 64);
          $table->string('api_token', 128)->index();
          $table->boolean('confirmed')->default(0);
          $table->string('token', 254)->nullable();
          $table->softDeletes();
          $table->timestamps();
      });
     }

     public function down()
     {
         Schema::dropIfExists('users');
     }
}
