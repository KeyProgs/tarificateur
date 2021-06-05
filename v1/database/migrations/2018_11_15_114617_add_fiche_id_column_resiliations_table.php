<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFicheIdColumnResiliationsTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('resiliations', function(Blueprint $table) {
         $table->integer('fiche_id')->unsigned()->after('id');
         $table->foreign('fiche_id')->references('id')->on('fiches');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::table('resiliations', function(Blueprint $table) {
         //
      });
   }
}
