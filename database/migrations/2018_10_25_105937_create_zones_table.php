<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('zones', function(Blueprint $table) {
         $table->increments('id');
         $table->integer('gamme_id')->unsigned();
         $table->foreign('gamme_id')->references('id')->on('gammes');
         $table->string('zone');
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
      Schema::dropIfExists('zones');
   }
}
