<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResiliationsTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('resiliations', function(Blueprint $table) {
         $table->increments('id');
         $table->string('organisme')->nullable();
         $table->string('motif')->nullable();
         $table->date('date_echeance')->nullable();
         $table->string('numero_police')->nullable();
         $table->longText('adresse')->nullable();
         $table->string('code_postale')->nullable();
         $table->integer('ville_id')->unsigned()->nullable();
         $table->foreign('ville_id')->references('id')->on('villes');
         $table->string('telephone')->nullable();
         $table->timestamps();
         $table->timestamp("deleted_at")->nullable();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::dropIfExists('resiliations');
   }
}
