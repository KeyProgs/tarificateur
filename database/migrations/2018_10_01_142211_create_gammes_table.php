<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGammesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('gammes', function(Blueprint $table) {
         $table->increments('id');

         $table->string('nom');
         $table->string('description')->nullable();

         $table->integer('compagnie_id')->unsigned();
         $table->foreign('compagnie_id')->references('id')->on('compagnies');

         $table->integer('type_assurance_id')->unsigned();
         $table->foreign('type_assurance_id')->references('id')->on('type_assurances');

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
      Schema::dropIfExists('gammes');
   }
}
