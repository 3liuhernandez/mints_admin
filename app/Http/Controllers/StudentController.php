<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            "fns_dni" => "required|int|unique:students,dni",
            "fns_name" => "required|string|min:2|max:150",
            "fns_last_name" => "required|string|min:2|max:150",
            "fns_email" => "nullable|email|unique:students,email",
            "fns_phone" => "nullable|int",
            "fns_address" => "nullable|string",
            "fns_course_id" => "nullable",
        ]);

        if ($validator->fails()) {
            return response([
                'validator' => $validator->errors(),
                'success' => false
            ], 422);
        }

        $response = [];
        $response['status'] = 200;
        $response['message'] = "Student has been created successful";

        $req = $validator->validated();
        $student = Student::store($req);
        Log::info("Student created:", [
            "student data"=> $student,
        ]);
        if ( ! $student ) {
            $response['status'] = 500;
            $response['message'] = "We can't save student data";
        }

        $response['success'] = $response['status'] === 200;
        $response['student'] = $student;

        return response($response, $response['status']);
    }
}
