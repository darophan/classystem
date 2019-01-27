<?php

use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schedules = [
            [
                'day' => 'Mon/Wed',
                'time' => '8:00-9:30'
            ],
            [
                'day' => 'Mon/Wed',
                'time' => '9:30-11:00'
            ],
            [
                'day' => 'Mon/Wed',
                'time' => '14:00-15:30'
            ],
            [
                'day' => 'Mon/Wed',
                'time' => '15:30-17:00'
            ],
            [
                'day' => 'Mon/Wed',
                'time' => '17:30-19:00'
            ],
            [
                'day' => 'Mon/Wed',
                'time' => '19:00-20:30'
            ],
            //
            [
                'day' => 'Tue/Thu',
                'time' => '8:00-9:30'
            ],
            [
                'day' => 'Tue/Thu',
                'time' => '9:30-11:00'
            ],
            [
                'day' => 'Tue/Thu',
                'time' => '14:00-15:30'
            ],
            [
                'day' => 'Tue/Thu',
                'time' => '15:30-17:00'
            ],
            [
                'day' => 'Tue/Thu',
                'time' => '17:30-19:00'
            ],
            [
                'day' => 'Tue/Thu',
                'time' => '19:00-20:30'
            ],
            //
            [
                'day' => 'Fri',
                'time' => '8:00-9:30'
            ],
            [
                'day' => 'Fri',
                'time' => '9:30-11:00'
            ],
            [
                'day' => 'Fri',
                'time' => '14:00-15:30'
            ],
            [
                'day' => 'Fri',
                'time' => '15:30-17:00'
            ],
            [
                'day' => 'Fri',
                'time' => '17:30-19:00'
            ],
            [
                'day' => 'Fri',
                'time' => '19:00-20:30'
            ],
            //
            [
                'day' => 'Sat',
                'time' => '8:00-9:30'
            ],
            [
                'day' => 'Sat',
                'time' => '9:30-11:00'
            ],
            [
                'day' => 'Sat',
                'time' => '14:00-15:30'
            ],
            [
                'day' => 'Sat',
                'time' => '15:30-17:00'
            ],
            [
                'day' => 'Sat',
                'time' => '17:30-19:00'
            ],
            [
                'day' => 'Sat',
                'time' => '19:00-20:30'
            ],
            //
            [
                'day' => 'Sun',
                'time' => '8:00-9:30'
            ],
            [
                'day' => 'Sun',
                'time' => '9:30-11:00'
            ],
            [
                'day' => 'Sun',
                'time' => '14:00-15:30'
            ],
            [
                'day' => 'Sun',
                'time' => '15:30-17:00'
            ],
            [
                'day' => 'Sun',
                'time' => '17:30-19:00'
            ],
            [
                'day' => 'Sun',
                'time' => '19:00-20:30'
            ],
        ];
        foreach ($schedules as $schedule) {
            DB::table('schedules')->insert([
                'day' => $schedule['day'],
                'time' => $schedule['time']
            ]);
        }
    }
}
