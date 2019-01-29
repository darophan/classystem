<?php

use Illuminate\Database\Seeder;

class TermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $terms = [
            [
                'name' => "Term Nov-2017-April-2018",
                'start_date' => "2017-11-30",
                'end_date' => "2018-04-09"
            ],

            [
                'name' => "Term April-2018-Aug-2018",
                'start_date' => "2018-04-19",
                'end_date' => "2018-08-20"
            ],

            [
                'name' => "Term Aug-2018-Nov-2018",
                'start_date' => "2018-08-27",
                'end_date' => "2018-11-20"
            ],

            [
                'name' => "Term Nov-2018-April-2019",
                'start_date' => "2018-11-30",
                'end_date' => "2019-04-07"
            ]
        ];
        foreach ($terms as $term) {
            DB::table('terms')->insert([
                'name' => $term['name'],
                'start_date' => $term['start_date'],
                'end_date' => $term['end_date']
            ]);
        }
    }
}
