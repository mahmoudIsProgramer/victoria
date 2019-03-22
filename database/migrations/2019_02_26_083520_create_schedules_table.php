<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
        
            $table->enum('period', ['1', '2', '3' ,'4' ,'5' , '6' ]); 
            $table->enum('day', ['Saturday', 'Sunday', 'Monday' , 'Tuesday' ,'Wednesday' , 'Thursday' ]);

            $table->integer('teacher_id')->unsigned()->nullable();

            $table->integer('material_id')->unsigned()->nullable();
    
            $table->integer('class_id')->unsigned()->nullable();



            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');

            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');

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
        Schema::dropIfExists('schedules');
    }
}
