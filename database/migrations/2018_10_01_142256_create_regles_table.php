<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReglesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('regles', function(Blueprint $table) {
         $table->increments('id');
         $table->integer('formule_id')->unsigned();
         $table->foreign('formule_id')->references('id')->on('formules');
         //$table->integer('age');
         //$table->float('prix', 5, 2);
         $table->timestamp('annee');
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
      Schema::dropIfExists('regles');
   }
}
