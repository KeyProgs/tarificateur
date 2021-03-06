<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpAdressesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('ip_adresses', function(Blueprint $table) {
         $table->increments('id');
         $table->string('adresse_ip');
         $table->longText('description')->nullable();
         $table->integer('user_id')->unsigned()->nullable();
         $table->foreign('user_id')->references('id')->on('users');
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
      Schema::dropIfExists('ip_adresses');
   }
}
