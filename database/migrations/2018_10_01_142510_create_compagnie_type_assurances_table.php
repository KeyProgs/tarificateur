<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompagnieTypeAssurancesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('compagnie_type_assurances', function(Blueprint $table) {
         $table->integer('type_assurance_id')->unsigned();
         $table->foreign('type_assurance_id')->references('id')->on('type_assurances');
         $table->integer('compagnie_id')->unsigned();
         $table->foreign('compagnie_id')->references('id')->on('compagnies');
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
      Schema::dropIfExists('compagnie_type_assurances');
   }
}
