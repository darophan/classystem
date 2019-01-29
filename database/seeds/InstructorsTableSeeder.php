<?php

use Illuminate\Database\Seeder;

class InstructorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $instructors = [
            'PHAN Daro',
            'LIM Hak Kruy',
            'Song Sokun',
            'Thol Theany',
            'KONG Phallack'
        ];
        foreach ($instructors as $instructor) {
            DB::table('instructors')->insert([
                'name' =>$instructor
            ]);
        }
    }
}
