<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsPersonnesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('details_personnes', function(Blueprint $table) {
         $table->increments('id');

         $table->integer('personne_id')->unsigned();
         $table->foreign('personne_id')->references('id')->on('personnes');

         $table->string('avenue_rue')->nullable();
         $table->string('numero_appartement_etage')->nullable();
         $table->string('residence_immeuble_batiment')->nullable();
         $table->string('numero')->nullable();
         $table->longText('adresse')->nullable();
         $table->string('ville')->nullable();
         $table->string('code_postal');

         $table->string('email')->nullable();
         $table->string('telephone_1');
         $table->string('telephone_2')->nullable();
         $table->string('telephone_3')->nullable();
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
      Schema::dropIfExists('details_personnes');
   }
}
