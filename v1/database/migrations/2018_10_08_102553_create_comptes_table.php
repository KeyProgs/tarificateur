<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComptesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('comptes', function(Blueprint $table) {
         $table->increments('id');
         $table->integer('personne_id')->unsigned();
         $table->foreign('personne_id')->references('id')->on('personnes');
         $table->integer('numero_carte');
         $table->string('iban');
         $table->longText('adresee')->nullable();
         $table->integer('banque_id')->unsigned();
         $table->foreign('banque_id')->references('id')->on('banques');
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
      Schema::dropIfExists('comptes');
   }
}
