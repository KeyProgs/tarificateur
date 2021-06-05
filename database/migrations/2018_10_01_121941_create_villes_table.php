<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('villes', function(Blueprint $table) {
         $table->increments('id');
         $table->string('nom');
         $table->integer('departement_id')->unsigned();
         $table->foreign('departement_id')->references('id')->on('departements');
         $table->string('insee_code')->nullable();;
         $table->string('zip_code')->nullable();
         $table->string('slug')->nullable();
         $table->string('gps_lat')->nullable();
         $table->string('gps_lng')->nullable();
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
      Schema::dropIfExists('villes');
   }
}
