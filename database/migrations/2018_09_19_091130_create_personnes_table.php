<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonnesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('personnes', function(Blueprint $table) {
         $table->increments('id');

         $table->string('nom');
         $table->string('prenom');

         $table->integer('civilite_id')->unsigned();
         $table->foreign('civilite_id')->references('id')->on('civilites');

         $table->date('date_naissance');

         $table->integer('regime_id')->unsigned();
         $table->foreign('regime_id')->references('id')->on('regimes');

         $table->integer('situation_familiale_id')->unsigned()->nullable();
         $table->foreign('situation_familiale_id')->references('id')->on('situation_familiales');
         $table->string('activite')->nullable();

         $table->string('numero_securite_sociale')->nullable();
         $table->string('numero_affiliation')->nullable();

         //$table->integer('id_conjoint')->unsigned()->nullable();
         //$table->foreign('id_conjoint')->references('id')->on('personnes');

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
      Schema::dropIfExists('personnes');
   }
}
