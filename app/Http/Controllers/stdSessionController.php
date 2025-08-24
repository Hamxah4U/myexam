<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class stdSessionController extends Controller
{
    public function index(){
        // $exam = Exam::with('questions.answers')->first();
        $exam = Exam::all();

        return view('examDashboard.index', compact('exam'));
    }

    public function show(){
        return view('stdlogin');
    }

    public function store(){
        $attributes = request()->validate([
            "email"=> ["required","email"],
            "password"=> "required",
        ]);

        if (!Auth::guard('student')->attempt(array_merge($attributes, ['status' => 'Active']))) {
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials or account not active',
            ]);
        }

        request()->session()->regenerate();

        // return redirect("/admin-dashboard");
        return redirect()->route('student.dashboard');
    }

    public function destroy() {
        Auth::guard('student')->logout();
        return redirect('/students-login');
    }
}
