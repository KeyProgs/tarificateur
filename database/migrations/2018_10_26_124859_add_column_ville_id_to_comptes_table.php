<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnVilleIdToComptesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('comptes', function(Blueprint $table) {
         $table->string('adresse')->nullable();
         $table->integer('ville_id')->unsigned()->after('adresse');
         $table->foreign('ville_id')->references('id')->on('villes');
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
