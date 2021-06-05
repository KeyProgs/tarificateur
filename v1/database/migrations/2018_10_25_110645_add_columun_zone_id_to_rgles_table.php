<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumunZoneIdToRglesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('regles', function(Blueprint $table) {
         $table->integer('zone_id')->unsigned()->after('annee');
         $table->foreign('zone_id')->references('id')->on('zones');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::table('regles', function(Blueprint $table) {
         //
      });
   }
}
