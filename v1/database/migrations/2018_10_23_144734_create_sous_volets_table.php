<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSousVoletsTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('sous_volets', function(Blueprint $table) {
         $table->increments('id');
         $table->integer('volet_id')->unsigned();
         $table->foreign('volet_id')->references('id')->on('volets');
         $table->string('valeur');
         $table->longText('description')->nullable();
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
      Schema::dropIfExists('sous_volets');
   }
}
