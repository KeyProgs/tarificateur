<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePieceJointesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('piece_jointes', function(Blueprint $table) {
         $table->increments('id');
         $table->integer('gamme_id')->unsigned();
         $table->foreign('gamme_id')->references('id')->on('gammes');
         $table->string('url');
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
      Schema::dropIfExists('piece_jointes');
   }
}
