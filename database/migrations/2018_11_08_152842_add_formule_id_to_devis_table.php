<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFormuleIdToDevisTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('devis', function(Blueprint $table) {
         $table->integer('formule_id')->unsigned()->after('mode_id');
         $table->foreign('formule_id')->references('id')->on('formules');
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
