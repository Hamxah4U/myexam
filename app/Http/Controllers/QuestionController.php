<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Course;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index(){
        $courses = Course::orderBy('id', 'desc')->get();
        return view('questions.index', compact('courses'));
    }

    public function create(Course $course){
        return view('questions.create', compact('course'));
    }
 
    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['required'],
            'option_a' => ['required'],
            'option_b' => ['required'],

            'option_c' => ['nullable'],
            'option_d' => ['nullable'],
            'correct_answer' => ['required', 'in:A,B,C,D,a,b,c,d'],
            'course_id' => ['required']
        ]);

            // Create only the question
        $question = Question::create([
            'name' => $validated['name'],
            'user_id' => Auth::id(),
            'course_id' => $validated['course_id']
        ]);

            // Now insert answer options
        $options = [
            'A' => $validated['option_a'],
            'B' => $validated['option_b'],
            // 'C' => $validated['option_c'],
            // 'D' => $validated['option_d'],
        ];

       
        if (!empty($validated['option_c'])) {
            $options['C'] = $validated['option_c'];
        }
        if (!empty($validated['option_d'])) {
            $options['D'] = $validated['option_d'];
        }
    

        foreach ($options as $label => $text) {
        Answer::create([
            'question_id' => $question->id,
            'answer_text' => $text,
            'is_correct' => strtoupper($validated['correct_answer']) === $label,
            'user_id' => Auth::id(),
            'course_id' => $validated['course_id']
        ]);
    }

        return redirect()->back()->with('success', 'Question and answers saved successfully!');
    }

    public function show(){
        $questions = Question::with(['answers'])->get();
        return view('questions.show', compact('questions'));
    }
}