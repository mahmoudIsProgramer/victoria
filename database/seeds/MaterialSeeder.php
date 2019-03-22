<?php

use Illuminate\Database\Seeder;
use App\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // start inset materials for grade 1
        Material::create([
            'school_id'=>1,
            'level_id' => 3, 
            'year_id' => 4 ,
            'name' => "English Grade1",
        ]); 
        Material::create([
            'school_id'=>1,
            'level_id' => 3,
            'year_id' => 4, 
            'name' => "Arabic Grade1",
        ]); 
        Material::create([
            'school_id'=>1,
            'level_id' => 3,
            'year_id' => 4,
            'name' => "Math Grade1 ",
        ]); 

        // end inset materials for grade 1

        // start inset materials for grade 2
        Material::create([
            'school_id'=>1,
            'level_id' => 3, 
            'year_id' => 5 ,
            'name' => "English Grade2",
        ]); 
        Material::create([
            'school_id'=>1,
            'level_id' => 3,
            'year_id' => 5, 
            'name' => "Arabic Grade2",
        ]); 
        Material::create([
            'school_id'=>1,
            'level_id' => 3,
            'year_id' => 5,
            'name' => "Math Grade2",
        ]); 

        // end inset materials for grade 2


        
        
    }
}
