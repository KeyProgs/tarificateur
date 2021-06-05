<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartementsTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('departements', function(Blueprint $table) {
         $table->increments('id');
         $table->string('nom');
         $table->string('region_id');
         $table->foreign('region_id')->references('id')->on('regions');
         $table->string('slug')->nullable();
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
      Schema::dropIfExists('departements');
   }
}
