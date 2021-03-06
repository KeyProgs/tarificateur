<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolePermissionsTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('role_permissions', function(Blueprint $table) {
         $table->integer('role_id')->unsigned();
         $table->foreign('role_id')->references('id')->on('roles');
         $table->integer('permission_id')->unsigned();
         $table->foreign('permission_id')->references('id')->on('permissions');
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
      Schema::dropIfExists('role_permissions');
   }
}
