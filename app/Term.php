<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = [
        'name',
        'start_date',
        'end_date'
    ];
    public function courses()
    {
        return $this->belongsToMany("App\Course", "course_term")
                    ->using("App\CourseTerm")
                    ->withPivot([
                        'schedule_id',
                        'is_taken',
                        'id'
                    ])
                    ->withTimestamps();
    }
    public function instructors()
    {
        return $this->belongsToMany("App\Instructor", "instructor_term")
                    ->using("App\InstructorTerm")
                    ->withPivot([
                        'schedule_id',
                        'id',
                        'course_id',
                        'is_taken',
                        'priority'
                    ])
                    ->withTimestamps();
    }

    // public function courseTerm()
    // {
    //     return $this->hasMany();
    // }

}
