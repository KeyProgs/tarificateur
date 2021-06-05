<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnGammeIdToSousVoletTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('sous_volets', function(Blueprint $table) {
         $table->integer('gamme_id')->unsigned()->after('description')->nullable();
         $table->foreign('gamme_id')->references('id')->on('gammes');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::table('sous_volets', function(Blueprint $table) {
         //
      });
   }
}
