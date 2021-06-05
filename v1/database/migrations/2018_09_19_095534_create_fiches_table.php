<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('fiches', function(Blueprint $table) {
         $table->increments('id');
         $table->integer('provenance_id')->unsigned();
         $table->foreign('provenance_id')->references('id')->on('provenances');

         $table->integer('user_id')->unsigned();
         $table->foreign('user_id')->references('id')->on('users');

         $table->longText('equipes_autorisees')->nullable();

         //$table->longText('equipe_id')->unsigned()->nullable();
         //$table->foreign('equipe_id')->references('id')->on('equipes');

         $table->integer('etat_id')->unsigned();
         $table->foreign('etat_id')->references('id')->on('fiche_etats');

         $table->integer('sous_etat_id')->unsigned();
         $table->foreign('sous_etat_id')->references('id')->on('fiche_sous_etats');

         $table->integer('personne_id')->unsigned();
         $table->foreign('personne_id')->references('id')->on('personnes');

         //$table->string('sous_statut')->nullable();

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
      Schema::dropIfExists('fiches');
   }
}
