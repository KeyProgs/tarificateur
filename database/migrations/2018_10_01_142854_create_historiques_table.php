<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriquesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('historiques', function(Blueprint $table) {
         $table->increments('id');
         $table->integer('user_id')->unsigned()->nullable();
         $table->foreign('user_id')->references('id')->on('users');
         $table->integer('fiche_id')->unsigned();
         $table->foreign('fiche_id')->references('id')->on('fiches');
         $table->integer('action_id')->unsigned();
         $table->foreign('action_id')->references('id')->on('actions');
         $table->longText('description')->nullable();
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
      Schema::dropIfExists('historiques');
   }
}
