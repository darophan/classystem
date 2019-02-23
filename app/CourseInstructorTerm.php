<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseInstructorTerm extends Pivot
{
    public function schedule()
    {
        return $this->belongsTo("App\Schedule");
    }
    public function instructor()
    {
        return $this->belongsTo("App\Instructor");
    }
    public function course()
    {
        return $this->belongsTo("App\Course");
    }
}
