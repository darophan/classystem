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
        DB::table("users")->insert( [
            'name' => 'darophan',
            'email' => 'darophan@app.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => str_random(10),
        ]);
    }
}
