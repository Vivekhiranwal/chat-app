<?php

namespace App\Http\Controllers;

use App\Models\Crud4;
// use Dotenv\Validator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class Crud4Controller extends Controller
{
    public function index()
    {
        return view('crud4.form');
    }
    public function show()
    {
        $user = Crud4::all();
        return response()->json([
            'user' => $user,
        ]);
    }
    public function store(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($Validator->fails()) {
            return response([
                'status' => 400,
                'errors' => $Validator->messages(),
            ]);
        } else {
            $user = new Crud4;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();
            return response()->json(
                [
                    'status' => 200,
                    'messages' => 'Student Added Successdfully ',
                ]
            );
        }
    }
    public function edit($id)
    {
        $user = Crud4::find($id);
        if ($user) {
            return response()->json(
                [
                    'status' => 200,
                    'student' => $user,
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'messages' => 'Student not found',
                ]
            );
        }
    }

    public function update(Request $request, $id)
    {
        $Validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required'
        ]);
        if ($Validator->fails()) {
            return response([
                'status' => 400,
                'errors' => $Validator->messages(),
            ]);
        } else {
            $user = Crud4::find($id);
            if ($user) {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->update();
                return response()->json(
                    [
                        'status' => 200,
                        'messages' => 'Student Updated Successdfully ',
                    ]
                );
            } else {
                return response()->json(
                    [
                        'status' => 404,
                        'messages' => 'Student not found',
                    ]
                );
            }
        }
    }
    public function delete($id)
    {
        $user = Crud4::find($id);
        if (!is_null($user)) {
            $user->delete();
        }
        return response()->json(
            [
                'status' => 200,
                'messages' => 'Student Delete Successfully',
            ]
        );
        
    }
}
