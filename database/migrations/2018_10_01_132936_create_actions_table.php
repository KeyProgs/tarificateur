<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('actions', function(Blueprint $table) {
         $table->increments('id');
         $table->string('action');
         $table->integer('type_action_id')->unsigned();
//         $table->foreign('type_action_id')->references('id')->on('type_actions');
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
      Schema::dropIfExists('actions');
   }
}
