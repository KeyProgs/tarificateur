<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegimeReglesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('regime_regles', function(Blueprint $table) {

         $table->integer('regime_id')->unsigned();
         $table->foreign('regime_id')->references('id')->on('regimes');

         $table->integer('regle_id')->unsigned();
         $table->foreign('regle_id')->references('id')->on('regles');
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::dropIfExists('regime_regles');
   }
}
