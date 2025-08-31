<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Exam;
use App\Models\Course;
use App\Models\Student;
use App\Models\StudentExam;
use Illuminate\Http\Request;
use App\Models\StudentAnswer;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index(){
        $exams = Exam::with('course')->get();
        return view('exam.index', compact('exams'));
    }

    public function create(){
        $courses = Course::all();
        return view('exam.create', compact('courses'));
    }

    public function store(){
        $attribute = request()->validate([
            'start_date' => ['required'],
            'course_id'  => ['required','unique:exams,course_id'],
            'name'       => ['required'],
            'end_date'   => ['required'],
            'duration'   => ['required']
        ]);

        $attribute['user_id'] = Auth::id();

        Exam::create($attribute);

        return redirect()->back()->with('success', 'Exam created successfully');
    }

    // public function show($examId, $questionIndex = 0){
    //     $exam = Exam::with(['course', 'user', 'questions.answers'])->findOrFail($examId);

    //     $studentExam = StudentExam::where('student_id', Auth::id())
    //         ->where('exam_id', $examId)
    //         ->firstOrFail();

    //     // If exam already completed, redirect
    //     if ($studentExam->status === 'completed') {
    //         return redirect()->route('student.dashboard')->with('error', 'Exam already completed.');
    //     }

    //     // Calculate remaining time
    //     $remainingSeconds = now()->diffInSeconds($studentExam->end_time, false);

    //     if ($remainingSeconds <= 0) {
    //         // Mark as completed if expired
    //         $studentExam->update(['status' => 'completed', 'end_time' => now()]);
    //         return redirect()->route('student.dashboard')->with('error', 'Exam time is over.');
    //     }

    //     $totalQuestions = $exam->questions->count();
    //     if ($questionIndex < 0 || $questionIndex >= $totalQuestions) {
    //         return redirect()->route('student.exams.show', [$examId, 0]);
    //     }

    //     $currentQuestion = $exam->questions->get($questionIndex);   

    //     // ✅ Shuffle answers before sending to view
    //     $currentQuestion->answers = $currentQuestion->answers->shuffle();

    //     $savedAnswer = StudentAnswer::where('student_id', Auth::id())
    //         ->where('exam_id', $exam->id)
    //         ->where('question_id', $currentQuestion->id)
    //         ->first();

    //     return view('examDashboard.show', compact(
    //         'exam',
    //         'currentQuestion',
    //         'questionIndex',
    //         'totalQuestions',
    //         'savedAnswer',
    //         'remainingSeconds'
    //     ));
    // }


    public function show($examId, $questionIndex = 0){
        $exam = Exam::with(['course', 'user', 'questions.answers'])->findOrFail($examId);

        $studentExam = StudentExam::where('student_id', Auth::id())
            ->where('exam_id', $examId)
            ->firstOrFail();

        // If exam already completed, redirect
        if ($studentExam->status === 'completed') {
            return redirect()->route('student.dashboard')->with('error', 'Exam already completed.');
        }

        // Calculate remaining time
        $remainingSeconds = now()->diffInSeconds($studentExam->end_time, false);

        if ($remainingSeconds <= 0) {
            // Mark as completed if expired
            $studentExam->update(['status' => 'completed', 'end_time' => now()]);
            return redirect()->route('student.dashboard')->with('error', 'Exam time is over.');
        }

        $totalQuestions = $exam->questions->count();
        if ($questionIndex < 0 || $questionIndex >= $totalQuestions) {
            return redirect()->route('student.exams.show', [$examId, 0]);
        }

        $currentQuestion = $exam->questions->get($questionIndex);   
        $currentQuestion->answers = $currentQuestion->answers->shuffle();     

        $savedAnswer = StudentAnswer::where('student_id', Auth::id())
            ->where('exam_id', $exam->id)
            ->where('question_id', $currentQuestion->id)
            ->first();

        return view('examDashboard.show', compact(
            'exam',
            'currentQuestion',
            'questionIndex',
            'totalQuestions',
            'savedAnswer',
            'remainingSeconds'
        ));
    }


    public function storeAnswer(Request $request, $examId, $questionIndex){
        // This part would now update DB instead of session
        StudentAnswer::updateOrCreate(
            [
                'student_id'  => Auth::id(),
                'exam_id'     => $examId,
                'question_id' => $request->question_id,
            ],
            [
                'answer_id'   => $request->answer_id,
                'course_id'   => $request->course_id,
                'status'      => 'onprocess',
            ]
        );

        return redirect()->route('student.exams.show', [
            'examId' => $examId,
            'questionIndex' => $questionIndex + 1
        ]);
    }

    public function startExam($examId){
        $exam = Exam::findOrFail($examId);

        // Ensure exam duration and status are valid
        if ($exam->status !== 'ongoing') {
            return redirect()->route('student.dashboard')->with('error', 'Exam is not available.');
        }

        // Create or fetch student exam record
        $studentExam = StudentExam::firstOrCreate(
            [
                'student_id' => Auth::id(),
                'exam_id' => $exam->id
            ],
            [
                'start_time' => now(),
                'end_time' => now()->addMinutes($exam->duration),
                'status' => 'ongoing'
            ]
        );

        return redirect()->route('student.exams.show', [$examId, 0]);
    }
     
}