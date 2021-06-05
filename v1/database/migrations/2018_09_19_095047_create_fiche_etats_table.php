<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFicheEtatsTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('fiche_etats', function(Blueprint $table) {
         $table->increments('id');
         $table->integer('etat_groupe_id')->unsigned()->after('id');
         $table->foreign('etat_groupe_id')->references('id')->on('etat_groupes');
         $table->string('valeur');
         $table->string('libelle');
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
      Schema::dropIfExists('fiche_etats');
   }
}
