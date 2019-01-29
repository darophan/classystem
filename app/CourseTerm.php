<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseTerm extends Pivot
{

    public function schedule()
    {
        return $this->belongsTo("App\Schedule");
    }
    public function instructor()
    {
        return $this->belongsTo("App\Instructor");
    }
}
