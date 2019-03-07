<?php

use App\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
   /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // American levels
        Level::create([
            'id'   =>1,
            'name' =>'Play',
            'school_id' =>1,
        ]); 
        Level::create([
            'id'   =>2,
            'name' =>'Kids',
            'school_id' =>1,
        ]); 
        Level::create([
            'id'   =>3,
            'name' =>'Grades',
            'school_id' =>1,
        ]); 
        
        // IG levels 
        Level::create([
            'id'   => 4,
            'name' =>'Secondary',
            'school_id' =>2,
        ]); 

        // International levels
        Level::create([
            'id'   => 5,
            'name' =>'Play',
            'school_id' =>3,
        ]);
        Level::create([
            'id'   => 6,
            'name' =>'Kids',
            'school_id' =>3,
        ]);
        Level::create([
            'id'   => 7,
            'name' =>'Primary One',
            'school_id' =>3,
        ]);
        Level::create([
            'id'   => 8,
            'name' =>'Primary Two',
            'school_id' =>3,
        ]);
        Level::create([
            'id'   => 9,
            'name' =>'Middle',
            'school_id' =>3,
        ]);
        Level::create([
            'id'   => 10,
            'name' =>'Secondary',
            'school_id' =>3,
        ]);
    }
}
