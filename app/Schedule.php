<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'day',
        'time'
    ];
    public function instructors()
    {
        return $this->belongsToMany("App\Instructor", "course_term");
    }
}
