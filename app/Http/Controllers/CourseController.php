<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(){
        return view('courses.index');
    }

    public function store(){
        $attrributes = request()->validate([
            'name' => ['required', 'unique:courses,name']
        ]);

        $attrributes['user_id'] = Auth::id();

        Course::create($attrributes);

        return redirect()->back()->with('success', 'Course save successfully!');
    }

    public function show(){
        $courses = Course::all();
        return view('courses.show', compact('courses'));
    }
}
