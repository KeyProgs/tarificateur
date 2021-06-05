<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVilleIdTtToTableComptes extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('comptes', function(Blueprint $table) {
         $table->integer('ville_id_tt')->unsigned()->nullable();
         $table->foreign('ville_id_tt')->references('id')->on('villes');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::table('comptes', function(Blueprint $table) {
         //
      });
   }
}
