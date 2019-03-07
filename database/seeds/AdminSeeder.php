<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Admin::create([
            'username' =>'mahmoud' ,
            'password' => '$2y$12$qSe0xhN2bgj0hOeRFEjdU.AmTBQZH7xg3nalF/Ob3s9lXm8GLHepe',
            'school_id' => 1 , 
            ]); 
    }
}
