<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValeursTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('valeurs', function(Blueprint $table) {
         $table->increments('id');
         $table->string('valeur');
         $table->longText('description')->nullable();
         $table->boolean('cas')->default(true)->nullable();
         $table->integer('formule_id')->unsigned();
         $table->foreign('formule_id')->references('id')->on('formules');
         $table->integer('sous_volet_id')->unsigned();
         $table->foreign('sous_volet_id')->references('id')->on('sous_volets');
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
      Schema::dropIfExists('valeurs');
   }
}
