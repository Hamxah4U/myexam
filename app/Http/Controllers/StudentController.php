<?php

namespace App\Http\Controllers;

use App\Models\Lga;
use App\Models\Level;
use App\Models\State;
use App\Models\Gender;
use App\Models\School;
use App\Models\Student;
use App\Models\Semester;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Academicsession;
use Illuminate\Support\Facades\Hash;



class StudentController extends Controller
{
    public function index()
    {
        $genders = Gender::all();
        $states = State::all();
        $levels = Level::all();
        $sessions = Academicsession::all();
        $semesteres = Semester::all();
        $schools = School::all();

        return view('students.index', compact('genders','states','levels', 'sessions', 'semesteres', 'schools'));
    }

   public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        
        // Validate the request
       $attributes = request()->validate([
        'first_name'=> ['required'],
        'surname'=> ['required'],
        'email'=> ['required','email','unique:students,email'],
        'phone'=> ['required','unique:students,phone'],
        'gender_id'=> ['required'],
        'school_id'=> ['required'],
        'department_id'=> ['required'],
        'state_id'=> ['required'],
        'lga_id'=> ['required'],
        'level_id'=> ['required'],
        'semester_id'=> ['required'],
        'academicsession_id'=> ['required'],
        'agree' => ['accepted'],
        'password'=> ['required'],
       ]);

       $attributes['password'] = Hash::make(request('password'));

       $attributes['password'] = Hash::make($attributes['password']);
        if(request()->filled('other_name')){
            $attributes['other_name'] = request('other_name');
        } 

        if(request()->filled('address')){
            $attributes['address'] = request('address');
        }

        if(request()->filled('dob')){
            $attributes['dob'] = request('dob');
        }

        $department = Department::findOrFail($attributes['department_id']);
        $count = Student::where('department_id', $attributes['department_id'])->count();
        $serial = str_pad($count + 1, 5, '0', STR_PAD_LEFT);
        $year = date('Y');
        $attributes['reg_no'] = "{$year}/{$serial}/{$department->department_code}";

       Student::create($attributes);

        // Redirect or return a response
        return redirect()->route('add-student')->with('success', 'Student added successfully.');
    }
     /* 
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }       

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students,email,' . $id,
            'age' => 'required|integer|min:0',
        ]);

        // Find the student and update their information
        $student = Student::findOrFail($id);
        $student->update($request->all());

        // Redirect or return a response
        return redirect()->route('add-student')->with('success', 'Student updated successfully.');
    }   

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('add-student')->with('success', 'Student deleted successfully.');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('students.show', compact('student'));
    }
 */

    public function getLgas($state_id)
    {
        $lgas = Lga::where('state_id', $state_id)->get(['id', 'name']);
        return response()->json($lgas);
    }

    public function get_Departments($school_id){
        $departments = Department::where( [
            ["school_id", $school_id],
            ["status", 'Active'],
        ])->get();
        return response()->json($departments);
    }

    public function getDepartmentCode($department_id){
        $department = Department::findOrFail($department_id);
        $count = Student::where('department_id', $department_id)->count();
        $serial = $count + 1;

        return response()->json([
            'department_code' => $department->department_code,
            'serial' => $serial
        ]);
    }

}
