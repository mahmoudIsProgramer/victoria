<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('name');
            
            $table->string('username');
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('student_id_in_school')->nullable(); // student number in school 
            $table->string('image')->nullable();



            $table->integer('level_id')->unsigned()->nullable();
            $table->integer('year_id')->unsigned()->nullable();
            $table->integer('school_id')->unsigned()->nullable();
            $table->integer('class_id')->unsigned()->nullable();
            
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('year_id')->references('id')->on('years')->onDelete('cascade');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');

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
        Schema::dropIfExists('students');
    }
}
