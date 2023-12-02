<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //   store data
    public function store(request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'image' => 'required'
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            $image = rand(1000, 9999) . '.' . $request->image->extension();
            $path = $request->image->storeAs('image', $image, 'public');
            $input['image'] = 'storage/' . $path;
        }


        $user =  User::create($input);
        $success['status'] = 200;
        $success['message'] = 'Data inserted';
        $success['data'] = $user;
        return response()->json(['success' => $success]);
    }


    // read data
    public function get_user()
    {
        $user = User::all();
        $success['status'] = 200;
        $success['message'] = 'done';
        $success['data'] = $user;
        return response()->json(['success' => $success]);


    }


    public function users()
    {
        $users = User::all();

        return view('first', compact('users'));
    }

    // update data
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            if ($request->name) {
                $user->name = $request->name;
            }
            if ($request->email) {
                $user->email = $request->email;
            }
            if ($request->password) {
                $user->password = $request->password;
            }
            if ($request->phone_number) {
                $user->phone_number = $request->phone_number;
            }
            if ($request->hasFile('image')) {
                $image = rand(1000, 9999) . '.' . $request->image->extension();
                $path = $request->image->storeAs('image', $image, 'public');
                $user->image = 'storage/' . $path;
            }


            $user->save();

            $success['status'] = 200;
            $success['message'] = 'product update Successfuly';
            $success['data'] = $user;
            return response()->json(['success' => $success]);
        } else {
            $success['status'] = 400;
            $success['message'] = 'User no found';
            return response()->json(['error' => $success]);
        }
    }

    // delete data
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        $success['status'] = 200;
        $success['message'] = 'User delete Successfuly';
        $success['data'] = $user;
        return response()->json(['success' => $success]);
    }



    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', '=', $request->email)->where('password', '=', $request->password)->first();

        if ($user) {
            $success['status'] = 200;
            $success['message'] = 'Login Successfuly';
            $success['data'] = $user;
            return response()->json(['success' => $success]);
        } else {
            $success['status'] = 400;
            $success['message'] = 'Incorrect Credential';
            return response()->json(['error' => $success]);
        }
    }
}
