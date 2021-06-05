<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFicheEtatIdColumnToDevisTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('devis', function(Blueprint $table) {
         $table->integer('fiche_etat_id')->unsigned()->after('simulation_id');;
         $table->foreign('fiche_etat_id')->references('id')->on('fiche_etats');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::table('devis', function(Blueprint $table) {
         //
      });
   }
}
