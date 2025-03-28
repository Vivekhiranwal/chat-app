<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\JaJobPost;

class UserController extends Controller
{
    public function view()
    {
        $student = Student::get();
        return view('crud3.index', compact('student'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $student = new Student;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->password = $request->password;
        $student->save();
        return redirect()->back();
    }
    public function getstudents()
    {
        $student = Student::all();
        return response()->json(['student' => $student]);
    }
    public function edit($id)
    {
        $student = Student::find($id);
        // $data = compact('student');
        // return redirect('/edit')->with($data);
    }


    public function createPost(Request $request)
    {
        // dd($request->all());
        // Validate the request
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'number_of_days' => 'required|string',
            'total_cost' => 'required|string',
            'zipcode' => 'required|string',
            'area' => 'required|string',
            'city' => 'required|string',
            'project_type' => 'required|string',
            'floor_maps_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate floor map images
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate job images
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
        ]);

        $floorMaps = [];

        if ($request->hasFile('floor_maps_image')) {
            $map = $request->file('floor_maps_image');

            if ($map->isValid()) {
                $originalName = $map->getClientOriginalName();
                $path = $map->storeAs('floor_maps', $originalName, 'public');

                $floorMaps[] = $originalName;  
            }
        }

        // Handle other images if any (like 'images' field)
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if ($image->isValid()) {
                    $path = $image->store('job_images', 'public');
                    $imagePaths[] = $path;
                }
            }
        }

        // Prepare data for the job post
        $jobPostData = [
            'user_id' => $validated['user_id'],
            'number_of_days' => $validated['number_of_days'],
            'total_cost' => $validated['total_cost'],
            'zipcode' => $validated['zipcode'],
            'area' => $validated['area'],
            'city' => $validated['city'],
            'project_type' => $validated['project_type'],
            'floor_maps_image' => !empty($floorMaps) ? json_encode($floorMaps) : null, // Store original names as JSON
            'image_paths' => !empty($imagePaths) ? json_encode($imagePaths) : null, // Store other image paths as JSON
            'description' => $validated['description'] ?? null,
            'tags' => $validated['tags'] ?? null,
        ];

        // Create the job post
        $jobPost = JaJobPost::create($jobPostData);

        // Return success response
        return response()->json([
            'message' => 'Job created successfully!',
            'data' => $jobPost,
        ], 201);
    }
}
