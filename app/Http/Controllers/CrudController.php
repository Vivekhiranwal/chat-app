<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CrudController extends Controller
{
    public function index()
    {
        return view('crud.form');
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'gender' => 'required',
            'city' => 'required|in:Delhi,Mumbai,Nasik',
        ]);

        try {
            $user = new User();
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->password = bcrypt($request->password);
            $user->gender = $request['gender'];
            $user->city = $request['city'];
            $user->save();

            return response()->json([
                'message' => 'Registration successfully!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while saving data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show()
    {
        $user = User::all();
        $data = compact('user');
        return view('crud.show')->with($data);
    }
    public function edit($id)
    {
        $user = User::find($id);
        $data = compact('user');
        return view('crud.edit')->with($data);
    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->gender = $request['gender'];
        $lang = $request->language;
        $user->city = $request['city'];
        $user->save();
        // $user->update($request->all());
        Session::flash('success', 'Data update successfully !');
        return redirect('/show');
    }
    public function delete($id)
    {
        $user = User::find($id);
        if (!is_null($user)) {
            $user->delete();
        }
        return redirect('/show');
    }
   
    public function login()
    {
        return view('crud.login');
    }
    public function loginstore(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Login successful!',
                'redirect' => url('/'),
            ]);
        }

        return response()->json([
            'message' => 'Invalid email or password. Please try again.',
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login')->with('success', 'Logged out successfully.');
    }
}
