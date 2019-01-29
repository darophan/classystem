<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            'Academic English Support Program 3',
            'Academic English Support Program 6',
            'Introduction to Law',
            'Introduction to Business Law',
            'IELTS Prep for 6.5'
        ];
        foreach ($courses as $course) {
            DB::table('courses')->insert([
                'name' => $course
            ]);
        }
    }
}
