<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Course extends Model
{
    use HasFactory;

    // append custom attributes
    protected $appends = ['slug'];

    public function getSlugAttribute() {
        return route('courses.show', $this->id);
    }

    // handle insert new course
    static public function store( array $data ) :? Course {
        try {
            $course = new Course;
            $course->title = $data['fnc_title'];
            $course->type = $data['fnc_type'];
            $course->status = $data['fnc_status'];
            if ( !empty($data['fnc_description']) ) $course->description = $data['fnc_description'];

            $course->save();
            return $course->refresh();
        } catch (\Throwable $th) {
            Log::error("Course create => {$th->getMessage()}");
            return null;
        }
    }
}
