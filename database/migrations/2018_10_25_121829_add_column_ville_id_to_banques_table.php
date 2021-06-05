<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnVilleIdToBanquesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('banques', function(Blueprint $table) {
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
      Schema::table('banques', function(Blueprint $table) {
         //
      });
   }
}
