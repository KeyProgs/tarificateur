<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTypeAssurancesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('user_type_assurances', function(Blueprint $table) {
         $table->increments('id');
         $table->integer('user_id')->unsigned();
         $table->foreign('user_id')->references('id')->on('users');
         $table->integer('type_assurance_id')->unsigned();
         $table->foreign('type_assurance_id')->references('id')->on('type_assurances');
         $table->timestamps();
         $table->timestamp('deleted_at')->nullable();
      });
   }

   /*
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::dropIfExists('user_type_assurances');
   }
}
