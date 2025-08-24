<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index(){
        
    }

    public function create(){
        $courses = Course::all();
        return view('exam.create', compact('courses'));
    }

    public function store(){
        $attribute = request()->validate([
            'start_date' => ['required'],
            'course_id' => ['required','unique:exams,course_id'],
            'name' => ['required'],
            'end_date' => ['required'],
            'duration' => ['required']
        ]);

        $attribute['user_id'] = Auth::id();

        Exam::create($attribute);

        return redirect()->back()->with('success', 'Exam created successfully');
    }

    public function show(){
        $exams = Exam::with(['course'])->get();
        return view('exam.show', compact('exams'));
    }
}
