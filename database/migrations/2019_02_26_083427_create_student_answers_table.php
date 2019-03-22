<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_answers', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('file_name') ;
            $table->integer('student_id')->unsigned()->nullable();
            $table->integer('homework_id')->unsigned()->nullable();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('homework_id')->references('id')->on('home_works')->onDelete('cascade');
            
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
        Schema::dropIfExists('student_answers');
    }
}
