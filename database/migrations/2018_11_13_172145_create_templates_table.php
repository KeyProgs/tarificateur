<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('templates', function(Blueprint $table) {
         $table->increments('id');
         $table->string('nom');
         $table->integer('type_id')->unsigned();
         $table->foreign('type_id')->references('id')->on('template_types');
         $table->longText('template');
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
      Schema::dropIfExists('templates');
   }
}
