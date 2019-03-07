<?php

use Illuminate\Database\Seeder;
use App\Classe;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // play classes 
        Classe::create([
            
            'name'=>'Play',
            'school_id'=>1,
            'level_id'=> 1,
            'year_id'=>1,

        ]);


        // kids classes 
        Classe::create([
            
            'name'=>'KG 1  A ',
            'school_id'=>1,
            'level_id'=>2,
            'year_id'=>2,

        ]);
        Classe::create([
            
            'name'=>'KG 2 A',
            'school_id'=>1,
            'level_id'=>2,
            'year_id'=>3,

        ]);
        

        // Grades  1 Classes

        Classe::create([
            
            'name'=>'A1',
            'school_id'=>1,
            'level_id'=>3,
            'year_id'=>4,

        ]);
        
        Classe::create([
            
            'name'=>'B1',
            'school_id'=>1,
            'level_id'=>3,
            'year_id'=>4,
        ]);

        Classe::create([
        
            'name'=>'C1',
            'school_id'=>1,
            'level_id'=>3,
            'year_id'=>4,
        ]);

        // Grades  2 Classes

        Classe::create([
            
            'name'=>'A2',
            'school_id'=>1,
            'level_id'=>3,
            'year_id'=>5,

        ]);
        
        Classe::create([
            
            'name'=>'B2',
            'school_id'=>1,
            'level_id'=>3,
            'year_id'=>5,
        ]);

        Classe::create([
        
            'name'=>'C2',
            'school_id'=>1,
            'level_id'=>3,
            'year_id'=>5,
        ]);


    }
}
