<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartementZonesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('departement_zones', function(Blueprint $table) {
         $table->increments('id');
         $table->integer('zone_id')->unsigned();
         $table->foreign('zone_id')->references('id')->on('zones');
         $table->integer('departement_id')->unsigned();
         $table->foreign('departement_id')->references('id')->on('departements');
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
      Schema::dropIfExists('departement_zones');
   }
}
