<?php

use Faker\Generator as Faker;

$factory->define(App\Schedule::class, function (Faker $faker) {
    return [
        [
            'day' => 'Mon/Wed',
            'time' => '8:00-9:30'
        ],
        [
            'day' => 'Mon/Wed',
            'time' => '9:30-11:00'
        ]
    ];
});
