<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsChatelResilToCompagniesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('compagnies', function(Blueprint $table) {
         $table->boolean('resil')->default(true)->after('logo')->nullable();
         $table->date('chatel')->after('resil')->nullable();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::table('compagnies', function(Blueprint $table) {
         //
      });
   }
}
