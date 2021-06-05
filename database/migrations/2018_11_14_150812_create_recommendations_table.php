<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommendationsTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('recommendations', function(Blueprint $table) {
         $table->increments('id');
         $table->integer('user_id')->unsigned();
         $table->foreign('user_id')->references('id')->on('users');
         $table->integer('interval_heure')->nullable();
         $table->integer('rappel_minute')->nullable();
         $table->integer('nbr_appel')->nullable();
         $table->timestamps();
         $table->timestamp("deleted_at")->nullable();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::dropIfExists('recommendations');
   }
}
