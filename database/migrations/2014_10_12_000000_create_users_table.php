<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('users', function(Blueprint $table) {
         $table->increments('id');
         $table->integer('role_id')->unsigned();
         $table->foreign('role_id')->references('id')->on('roles');
         $table->string('nom');
         $table->string('prenom');
         $table->string('titre')->nullable();
         $table->string('email')->unique();
         $table->string('telephone');
         $table->string('photo')->nullable();
         $table->longText('adresse')->nullable();
         $table->date('date_naissance')->nullable();
         $table->longText('commentaire')->nullable();
         $table->timestamp('email_verified_at')->nullable();
         $table->string('password');
         $table->rememberToken();
         $table->timestamps();
         $table->timestamp('deleted_at')->nullable();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::dropIfExists('users');
   }
}
