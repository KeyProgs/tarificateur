<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimulationsTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('simulations', function(Blueprint $table) {
         $table->increments('id');
         $table->integer('user_id')->unsigned();
         $table->foreign('user_id')->references('id')->on('users');
         $table->integer('type_assurance_id')->unsigned();
         $table->foreign('type_assurance_id')->references('id')->on('type_assurances');
         $table->integer('fiche_id')->unsigned();
         $table->foreign('fiche_id')->references('id')->on('fiches');
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
      Schema::dropIfExists('simulations');
   }
}
