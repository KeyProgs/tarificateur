<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVilleIdToTableCompagnies extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('compagnies', function(Blueprint $table) {
         $table->string('adresse2')->nullable();
         $table->integer('ville_id')->unsigned()->after('adresse2')->nullable();
         $table->foreign('ville_id')->references('id')->on('villes');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::table('compagnies', function(Blueprint $table) {
         //
      });
   }
}
