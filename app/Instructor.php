<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $fillable = [
        'name'
    ];
    public function schedules()
    {
        return $this->belongsToMany("App\Schedule", "course_term");
    }
}
