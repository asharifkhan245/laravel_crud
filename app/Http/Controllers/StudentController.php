<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function store_student(Request $request)
    {

        $request->validate([
            "name" => "required",
            "email" => "required",
            "class" => "required",
            "password" => "required"
        ]);

        $input  =  $request->all();

        $student = Student::create($input);

        $success["status"] = 200;
        $success["message"] = "student inserted successfully";
        $success["data"] = $student;
        return response()->json(['success' => $success]);
    }

    public function update_student(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'class' => 'required',
            'phone_number' => 'required'
        ]);

        $update_student = Student::find($id);

        if ($update_student) {
            if ($request->name) {
                $update_student->name = $request->name;
            }
            if ($request->email) {
                $update_student->email = $request->email;
            }
            if ($request->class) {
                $update_student->class = $request->class;
            }
            if ($request->phone_number) {
                $update_student->phone_number = $request->phone_number;
            }

            $update_student->save();

            $success['status'] = 200;
            $success['message'] = 'update successfully';
            $success['data'] = $update_student;

            return response()->json(['success' => $success]);
        } else {
            $success['status'] = 400;
            $success['message'] = 'user no found';
            return response()->json(['error' => $success]);
        }
    }


    public function delete_student($id)
    {

        $delete_student = Student::find($id);
        $delete_student->delete();

        $success['status'] = 200;
        $success['message'] = 'delete successfully';
        $success['data'] =  $delete_student;

        return response()->json(['success' => $success]);
    }
    public function get_student()
    {

        $student =  Student::all();

        $success['status'] = 200;
        $success['message'] = 'done';
        $success['data'] = $student;

        return response()->json(['success' => $success]);
    }


    public function login_student(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $student = Student::where('email', '=', $request->email)->where('password', '=', $request->password)->first();
        if ($student) {
            $success['status'] = 200;
            $success['message'] = 'login successfully';
            $success['data'] = $student;
            return response()->json(['success' => $success]);
        }
    }

    public function session_set(Request $request)
    {
        $request->session()->put('my_name', 'john');

        return redirect('/first')->with('status', 'delete data succcessfully');
       
    }



}
