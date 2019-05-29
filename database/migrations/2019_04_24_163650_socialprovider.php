<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Socialprovider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('socialprovider',function (Blueprint  $table){
          $table->increments('id');
          $table->string('provide_id');
          $table->string('email');
          $table->string('provider');
           $table->dateTime('created_at');
           $table->dateTime('updated_at');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
