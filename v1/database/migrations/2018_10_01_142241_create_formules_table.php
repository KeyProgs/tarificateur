<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formules', function (Blueprint $table) {
           $table->increments('id');

           $table->string('nom');
           $table->string('description')->nullable();
           $table->integer('gamme_id')->unsigned();
           $table->foreign('gamme_id')->references('id')->on('gammes');
           $table->timestamps();
           $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formules');
    }
}
