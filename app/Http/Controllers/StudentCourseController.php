<?php

namespace App\Http\Controllers;

use App\Enums\SystemCode;
use App\Models\Student_Course;
use Illuminate\Http\Request;


class StudentCourseController extends Controller
{
    public function index()
    {
        try {
            $courses = Student_Course::select('code', 'student_code', 'course_code')
                ->with(['student' => function ($query) {
                    $query->where('status', '=', 1);
                }])
                ->with(['course' => function ($query) {
                    $query->where('status', '=', 1);
                }])
                ->get();
            return response()->json(['status' => 200, 'courses' => $courses]);
        } catch (\Exception $e) {
            return  response()->json([
                'status' => 500,
                'message' => $e
            ]);
        }
    }

    public function show($id)
    {
        try {

            $course = Student_Course::select('student_code', 'course_code')
                ->with(['student' => function ($query) {
                    $query->where('status', '=', 1);
                }])
                ->with(['course' => function ($query) {
                    $query->where('status', '=', 1);
                }])
                ->where('code', '=', $id)
                ->first();
            return response()->json(['status' => 200, 'course' => $course]);
        } catch (\Exception $e) {
            return  response()->json([
                'status' => 500,
                'message' => $e
            ]);
        }
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $sys_code = SystemCode::StudentCourseSysCode;
        $max_code = Student_Course::max('code');
        $Course_code = $max_code == null ? config('global.code_value') + 1 : substr("$max_code", 3) + 1;

        try {
            $course = Student_Course::create([
                'code' => $sys_code . $Course_code,
                'student_code' => $request->student_code,
                'course_code' => $request->course_code,
            ]);
            return response()->json(['status' => 200, 'Message' => 'Student_Course Created']);
        } catch (\Exception $e) {
            return  response()->json([
                'status' => 500,
                'message' => $e
            ]);
        }
    }





    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        try {
            $course = Student_Course::where('code', $id)->first();
            $course->update([
                'student_code' => $request->student_code,
                'course_code' => $request->course_code,
            ]);
            return response()->json(['status' => 200, 'Message' => 'Student_Course Updated']);
        } catch (\Exception $e) {
            return  response()->json([
                'status' => 500,
                'message' => $e
            ]);
        }
    }


    public function destroy($id)
    {
        try {

            $course = Student_Course::where('code', $id)->delete();
            return response()->json(['status' => 200, 'Message' => 'Student_Course Delete']);
        } catch (\Exception $e) {
            return  response()->json([
                'status' => 500,
                'message' => $e
            ]);
        }
    }
}