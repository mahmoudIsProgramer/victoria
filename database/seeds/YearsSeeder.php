<?php

use App\Year;
use Illuminate\Database\Seeder;

class YearsSeeder extends Seeder
{

    public function run()
    {
        // start American 
        
        // paly 
        Year::create([
            'id'=>1,
            'name' => 'Play' ,
            'level_id' =>1,
            'school_id' => 1 
        ]); 

        // kids 
        Year::create([
            'id'=>2,
            'name' => 'KG 1' ,
            'level_id' =>2,
            'school_id' => 1 

        ]); 

        Year::create([
            'id'=>3,
            'name' => 'KG 2' ,
            'level_id' =>2,
            'school_id' => 1 

        ]); 

        // grades
        Year::create([
            'id'=>4,
            'name' => 'Grade 1' ,
            'level_id' =>3,
            'school_id' => 1 

        ]); 
        Year::create([
            'id'=>5,
            'name' => 'Grade 2' ,
            'level_id' =>3,
            'school_id' => 1 

        ]); 
        Year::create([
            'id'=>6,
            'name' => 'Grade 3' ,
            'level_id' =>3,
            'school_id' => 1 

        ]); 
        Year::create([
            'id'=>7,
            'name' => 'Grade 4' ,
            'level_id' =>3,
            'school_id' => 1 

        ]); 
        Year::create([
            'id'=>8,
            'name' => 'Grade 5' ,
            'level_id' =>3,
            'school_id' => 1 

        ]); 
        Year::create([
            'id'=>9,
            'name' => 'Grade 6' ,
            'level_id' =>3,
            'school_id' => 1 

        ]); 
        Year::create([
            'id'=>10,
            'name' => 'Grade 7' ,
            'level_id' =>3,
            'school_id' => 1 

        ]); 
        Year::create([
            'id'=>11,
            'name' => 'Grade 8' ,
            'level_id' =>3,
            'school_id' => 1 

        ]); 
        Year::create([
            'id'=>12,
            'name' => 'Grade 9' ,
            'level_id' =>3,
            'school_id' => 1 

        ]); 
        Year::create([
            'id'=>13,
            'name' => 'Grade 10' ,
            'level_id' =>3,
            'school_id' => 1 

        ]); 
        Year::create([
            'id'=>14,
            'name' => 'Grade 11' ,
            'level_id' =>3,
            'school_id' => 1 

        ]); 
        Year::create([
            'id'=>15,
            'name' => 'Grade 12' ,
            'level_id' =>3,
            'school_id' => 1 

        ]); 
        // end American 

    }
}
