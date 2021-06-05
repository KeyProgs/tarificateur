<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartementReglesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('departement_regles', function(Blueprint $table) {
         $table->integer('regle_id')->unsigned();
         $table->foreign('regle_id')->references('id')->on('regles');
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
      Schema::dropIfExists('departement_regles');
   }
}
