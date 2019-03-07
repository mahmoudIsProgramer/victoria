<?php

use Illuminate\Database\Seeder;
use App\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0; $i < 10 ; $i++) { 
            Student::create([
                'name'=>str_random(30) . $i ,
                'username'=>str_random(30) . $i ,
                'password'=>"mahmoud" ,
                'phone'=>"01111111111" ,
                'address'=>str_random(30) . $i ,
                'email'=>str_random(30) . $i ,
                'student_id_in_school'=> $i ,
                'image'=>str_random(30) . $i ,
                'class_id'=>4,
                // 'level_id'=>1 ,
                // 'year_id'=>1 ,
                // 'school_id'=>1 ,
            ]); 
        }
        for ($i=0; $i < 10 ; $i++) { 
            Student::create([
                'name'=>str_random(30) . $i ,
                'username'=>str_random(30) . $i ,
                'password'=>"mahmoud" ,
                'phone'=>"01111111111" ,
                'address'=>str_random(30) . $i ,
                'email'=>str_random(30) . $i ,
                'student_id_in_school'=> $i ,
                'image'=>str_random(30) . $i ,
                'class_id'=>5,
                // 'level_id'=>1 ,
                // 'year_id'=>1 ,
                // 'school_id'=>1 ,
            ]); 
        }

    }
}
