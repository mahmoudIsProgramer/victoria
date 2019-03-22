<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('teacher_class')->insert([
            [
                'teacher_id'=>1,
                'class_id'   => 4 , 
            ],
            [
                'teacher_id'=>1,
                'class_id'   => 5 , 
            ]
        ]); 

    }
}
