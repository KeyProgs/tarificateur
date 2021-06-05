<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVilleIdToTableDetailsPersonnes extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('details_personnes', function(Blueprint $table) {
         $table->integer('ville_id')->unsigned()->after('adresse')->nullable();
         $table->foreign('ville_id')->references('id')->on('villes');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::table('details_personnes', function(Blueprint $table) {
         //
      });
   }
}
