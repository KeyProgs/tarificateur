<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumunDevisIdToHistoriquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('historiques', function (Blueprint $table) {
            $table->integer('devis_id')->unsigned()->nullable()->after("fiche_id");
            $table->foreign('devis_id')->references('id')->on('devis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historiques', function (Blueprint $table) {
            //
        });
    }
}
