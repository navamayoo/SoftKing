<?php

namespace App\Http\Controllers;

use App\Enums\SystemCode;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index()
    {
        try {
            $courses = Course::select('code', 'name', 'description', 'status')
                ->where('status', '=', 1)
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
            $course = Course::select('code', 'name', 'description', 'status')
                ->where('code', '=', $id)->where('status', '=', 1)
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
        try {
            $sys_code = SystemCode::CourseSysCode;
            $max_code = Course::max('code');
            $Course_code = $max_code == null ? config('global.code_value') + 1 : substr("$max_code", 3) + 1;

            Course::create([
                'code' => $sys_code . $Course_code,
                'name' => $request->name,
                'description' => $request->description
            ]);
            return response()->json(['status' => 200, 'Message' => 'Course Created']);
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

            $course = Course::where('code', $id)->first();
            $course->update([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status
            ]);
            return response()->json(['status' => 200, 'Message' => 'Course Updated']);
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
            $course = Course::where('code', $id)->delete();
            return response()->json(['status' => 200, 'Message' => 'Course Delete']);
        } catch (\Exception $e) {
            return  response()->json([
                'status' => 500,
                'message' => $e
            ]);
        }
    }
}