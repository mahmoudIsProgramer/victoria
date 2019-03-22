<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SchoolsSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(YearsSeeder::class);
        $this->call(ClassesSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(MaterialSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(TeacherClassSeeder::class);
    }
}
