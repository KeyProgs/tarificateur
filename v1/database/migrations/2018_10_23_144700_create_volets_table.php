<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoletsTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('volets', function(Blueprint $table) {
         $table->increments('id');
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
      Schema::dropIfExists('volets');
   }
}
