<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index(){}

    public function create(){
        return view('questions.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['required'],
            'option_a' => ['required'],
            'option_b' => ['required'],

            'option_c' => ['nullable'],
            'option_d' => ['nullable'],
            'correct_answer' => ['required', 'in:A,B,C,D,a,b,c,d'],
        ]);

            // Create only the question
        $question = Question::create([
            'name' => $validated['name'],
            'user_id' => Auth::id(),
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
        ]);
    }

        return redirect()->back()->with('success', 'Question and answers saved successfully!');
    }
}
