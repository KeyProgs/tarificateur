<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsterisquesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('asterisques', function(Blueprint $table) {
         $table->increments('id');
         $table->string('valeur');
         $table->longText('description')->nullable();
         $table->integer('sous_volet_id')->unsigned()->nullable();
         $table->foreign('sous_volet_id')->references('id')->on('sous_volets');
         $table->integer('valeur_id')->unsigned()->nullable();
         $table->foreign('valeur_id')->references('id')->on('valeurs');
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
      Schema::dropIfExists('asterisques');
   }
}
