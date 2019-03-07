<?php

use Illuminate\Database\Seeder;
use App\Teacher;

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

            ]);
    }
}
