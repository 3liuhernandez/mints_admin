<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    //

    public function show(Request $request, int $id) {
        dd($id);
        section("courses");
        return view("courses/view");
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            "fnc_type" => "required|int|exists:course_types,code",
            "fnc_status" => "required|int|exists:course_statuses,code",
            "fnc_title" => "required|string|min:2|max:150",
            "fnc_description" => "nullable|string",
        ]);

        if ($validator->fails()) {
            return response([
                'validator' => $validator->errors(),
                'success' => false
            ], 422);
        }

        $response = [];
        $response['status'] = 200;
        $response['message'] = "Course has been created successful";

        $req = $validator->validated();
        $course = Course::store($req);
        Log::info("course created:", [
            "course data"=> $course,
        ]);
        if ( ! $course ) {
            $response['status'] = 500;
            $response['message'] = "We can't save course data";
        }

        $response['success'] = $response['status'] === 200;
        $response['course'] = $course;

        return response($response, $response['status']);
    }
}
