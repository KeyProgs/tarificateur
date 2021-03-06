<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEquipesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('user_equipes', function(Blueprint $table) {
         $table->integer('user_id')->unsigned()->nullable();
         $table->foreign('user_id')->references('id')->on('users');
         $table->integer('equipe_id')->unsigned()->nullable();
         $table->foreign('equipe_id')->references('id')->on('equipes');
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
      Schema::dropIfExists('user_equipes');
   }
}
