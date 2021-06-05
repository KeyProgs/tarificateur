<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrixFormulesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('prix_formules', function(Blueprint $table) {
         $table->increments('id');
         $table->integer('regle_id')->unsigned();
         $table->foreign('regle_id')->references('id')->on('regles');
         $table->integer('age');
         $table->float('prix', 5, 2);
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
      Schema::dropIfExists('prix_formules');
   }
}
