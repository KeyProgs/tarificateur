<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function(Blueprint $table) {
            $table->increments('id');
            $table->string('option')->nullable();

            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }
DB::table('users')->insert(['nom'=>'KPSupport','telephone'=>'000','prenom'=>'KPSupport','email'=>'keyprogs@gmail.com','password'=>Hash::make('123456'),'role_id'=>1])


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('options', function (Blueprint $table) {
            //
        });
    }
}
