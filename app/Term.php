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
                        'instructor_id'
                    ]);;
    }
    public function courseTerm()
    {
        return $this->hasMany();
    }

}
