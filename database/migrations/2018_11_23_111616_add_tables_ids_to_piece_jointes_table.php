<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTablesIdsToPieceJointesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('piece_jointes', function(Blueprint $table) {

         $table->integer('formule_id')->unsigned()->nullable()->after("id");
         $table->foreign('formule_id')->references('id')->on('formules');

         $table->integer('compagnie_id')->unsigned()->nullable()->after("gamme_id");
         $table->foreign('compagnie_id')->references('id')->on('compagnies');

         $table->integer('fiche_id')->unsigned()->nullable()->after("compagnie_id");
         $table->foreign('fiche_id')->references('id')->on('fiches');

         $table->integer('devis_id')->unsigned()->nullable()->after("fiche_id");
         $table->foreign('devis_id')->references('id')->on('devis');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::table('piece_jointes', function(Blueprint $table) {
         //
      });
   }
}
