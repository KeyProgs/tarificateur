<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuthColumunsToPersonnesTabl extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('personnes', function(Blueprint $table) {
         $table->timestamp('email_verified_at')->after("numero_affiliation")->nullable();
         $table->string('password')->after("email_verified_at")->nullable();
         $table->rememberToken()->after("password")->nullable();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::table('personnes', function(Blueprint $table) {
         //
      });
   }
}
