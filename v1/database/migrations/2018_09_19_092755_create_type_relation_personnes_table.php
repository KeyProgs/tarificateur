<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PersonnePersonnesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('personne_personnes', function(Blueprint $table) {
         $table->increments('id');
         $table->integer('personne_id')->unsigned()->nullable();
         $table->foreign('personne_id')->references('id')->on('personnes');

         $table->integer('personne_concerne_id')->unsigned()->nullable();
         $table->foreign('personne_concerne_id')->references('id')->on('personnes');

         $table->string('type_relation');

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
      Schema::dropIfExists('personne_personnes');
   }
}
