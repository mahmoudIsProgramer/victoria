<?php

use Illuminate\Database\Seeder;
use App\Teacher;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Teacher::create([
            'name' => 'mahmoud ahmed',
            'username' =>'mahmoud',
            'email'=>'mahmouddief0@gmail.com',
            'address' => 'addressdda ',
            'school_id'=> 1 , 
            'password'=>'$2y$12$qSe0xhN2bgj0hOeRFEjdU.AmTBQZH7xg3nalF/Ob3s9lXm8GLHepe',

            ]);

            Teacher::create([
                'name' => 'mahmoud ahmed',
                'username' =>'mahmoud1',
                'email'=>'mahmouddief2020@gmail.com',
                'address' => 'addressdda ',
                'school_id'=> 1 , 
                'password'=>'$2y$12$qSe0xhN2bgj0hOeRFEjdU.AmTBQZH7xg3nalF/Ob3s9lXm8GLHepe',
    
            ]);

            DB::table('teacher_material')->insert([
                ['teacher_id'=>1,
                'material_id'=>1],
                
                ['teacher_id'=>2,
                'material_id'=>2],
            ]); 


    }
}
