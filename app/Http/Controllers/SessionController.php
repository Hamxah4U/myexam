<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create(){
        return view("users.index");
    }

    public function store(){
        $attributes = request()->validate([
            "email"=> ["required","email"],
            "password"=> "required",
        ]);

       if (!Auth::attempt(array_merge($attributes, ['status' => 'Active']))) {
        throw ValidationException::withMessages([
            "email" => "Invalid credentials or account not active"
        ]);
    }


        request()->session()->regenerate();

        if(auth::guest()){
            return redirect("/");
        }
        return redirect("/admin-dashboard");

    }

    public function destroy(){
        Auth::logout();
        return redirect("/");
    }  
}