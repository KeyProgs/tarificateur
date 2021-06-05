<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevisTable extends Migration {
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('devis', function(Blueprint $table) {
         $table->increments('id');
         $table->float('cotisation', 5, 2);
         $table->float('reduction', 5, 2)->nullable();
         $table->integer('numero_contrat')->nullable();
         $table->date('date_debut');
         $table->date('date_fin')->nullable();
         $table->integer('simulation_id')->unsigned();
         $table->foreign('simulation_id')->references('id')->on('simulations');
         /*$table->integer('etat_devis_id')->unsigned();
         $table->foreign('etat_devis_id')->references('id')->on('etat_devis');*/
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
      Schema::dropIfExists('devis');
   }
}
