<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToTableComptes extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('comptes', function(Blueprint $table) {
         $table->integer('fiche_id')->unsigned();
         $table->foreign('fiche_id')->references('id')->on('fiches');
         $table->string('nom')->nullable();
         $table->string('prenom')->nullable();
         $table->longText('adresse_tt')->nullable();
         $table->string('code_postal_tt')->nullable();
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
