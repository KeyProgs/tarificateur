<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupeEtatRolesTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('groupe_etat_roles', function(Blueprint $table) {
         $table->integer('role_id')->unsigned();
         $table->foreign('role_id')->references('id')->on('roles');
         $table->integer('etat_groupe_id')->unsigned();
         $table->foreign('etat_groupe_id')->references('id')->on('etat_groupes');
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
      Schema::dropIfExists('groupe_etat_roles');
   }
}
