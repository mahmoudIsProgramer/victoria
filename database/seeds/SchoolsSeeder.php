<?php

use Illuminate\Database\Seeder;
use App\School;

class SchoolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        School::create([
            'id'   =>1,
            'name' =>'American',
        ]); 
        School::create([
            'id'   =>2,
            'name' =>'IG',
        ]); 
        School::create([
            'id'   =>3,
            'name' =>'National',
        ]); 
        

    }
}
