<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolController extends Controller
{
    public function index(){
        return view('schools.index');
    }

    public function store(){
        $attribute = request()->validate([
            'name' => ['required', 'unique:schools,name']
        ]);

        $attribute['user_id'] = Auth::id();

        School::create($attribute);

        return redirect()->back()->with('success','School added successfully!');
    }
}