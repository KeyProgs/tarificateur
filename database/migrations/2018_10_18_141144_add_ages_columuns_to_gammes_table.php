<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAgesColumunsToGammesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('gammes', function(Blueprint $table) {
         $table->integer('e_age')->nullable();
         $table->integer('min_age')->nullable();
         $table->integer('max_age')->nullable();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::table('gammes', function(Blueprint $table) {
         //
      });
   }
}
