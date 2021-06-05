<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumunTypeIdToPieceJointesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('piece_jointes', function (Blueprint $table) {
           $table->integer('type_id')->unsigned()->nullable()->after("description");
           $table->foreign('type_id')->references('id')->on('piece_jointe_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('piece_jointes', function (Blueprint $table) {
            //
        });
    }
}
