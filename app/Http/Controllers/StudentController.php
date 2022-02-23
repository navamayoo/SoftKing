<?php

namespace App\Http\Controllers;

use App\Enums\SystemCode;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        try {
            $students = Student::select('code','firstName', 'secondName', 'address1', 'address2', 'gender', 'dob', 'phoneNumber', 'email')
                ->where('isActive', '=', 1)
                ->get();
            return response()->json(['status' => 200, 'students' => $students]);
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
            $student = Student::select('code','firstName', 'secondName', 'address1', 'address2', 'gender', 'dob', 'phoneNumber', 'email')
                ->where('code', '=', $id)->where('isActive', '=', 1)
                ->first();
            return response()->json(['status' => 200, 'student' => $student]);
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
       // try {

            $sys_code = SystemCode::StudentSysCode;
            $max_code = Student::max('code');
            $Student_code = $max_code == null ? config('global.code_value') + 1 : substr("$max_code", 3) + 1;

            Student::create([
                'code' => $sys_code . $Student_code,
                'firstName' => $request->firstName,
                'secondName' => $request->secondName,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'phoneNumber' => $request->phoneNumber,
                'email' => $request->email,
            ]);
            return response()->json(['status' => 200,  'message' => "Student Created"], 200);
        // } catch (\Exception $e) {
        //     return  response()->json([
        //         'status' => 500,
        //         'message' => $e
        //     ]);
        // }
    }





    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
      //  try {

            $student = Student::where('code', $id)->first();
            $student->update([
                'firstName' => $request->firstName,
                'secondName' => $request->secondName,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'phoneNumber' => $request->phoneNumber,
                'email' => $request->email,

               // 'isActive' => $request->isActive
            ]);
            return response()->json(['status' => 200,  'message' => "Student Updated"], 200);
        // } catch (\Exception $e) {
        //     return  response()->json([
        //         'status' => 500,
        //         'message' => $e
        //     ]);
        // }
    }


    public function destroy($id)
    {
        try {
            $student = Student::where('code', $id)->delete();
            return response()->json(['status' => 200,  'message' => "Student Deleted"], 200);
        } catch (\Exception $e) {
            return  response()->json([
                'status' => 500,
                'message' => $e
            ]);
        }
    }
}