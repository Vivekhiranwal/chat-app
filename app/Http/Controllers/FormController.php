<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        return view('crud2.form');
    }
    public function store(Request $request)
    {

 
        $customer = new customer;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = $request->password;
        
        $customer->save();
        
        return redirect()->back();
    }
    public function show()
    {
        
        $customer = customer::all();
        $data = compact('customer');
        return view('crud2.customer-view')->with($data);
    }
    public function edit($id)
    {
        $customer = customer::find($id);
        $data = compact('customer');
        return view('crud.show')->with($data);
    }
}
