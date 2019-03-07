<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('name');
            
            $table->string('username');
            $table->string('password');
            $table->string('phone');
            $table->string('address');
            $table->string('email');




            
            $table->integer('school_id')->unsigned()->nullable();
            // $table->integer('level_id')->unsigned()->nullable();
            // $table->integer('years_ids')->unsigned()->nullable();
            // $table->integer('classes_ids')->unsigned()->nullable();
            // $table->integer('material_id')->unsigned()->nullable();

            
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            // $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            // $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
