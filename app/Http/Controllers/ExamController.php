<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\StudentAnswer;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with('course')->get();
        return view('exam.index', compact('exams'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('exam.create', compact('courses'));
    }

    public function store()
    {
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

    public function show($examId, $questionIndex = 0)
    {
        $exam = Exam::with(['course', 'user', 'questions.answers'])->findOrFail($examId);
        $totalQuestions = $exam->questions->count();

        // Ensure valid index
        if ($questionIndex < 0 || $questionIndex >= $totalQuestions) {
            return redirect()->route('student.exams.show', [$examId, 0]);
        }

        $currentQuestion = $exam->questions->get($questionIndex);

        $savedAnswer = StudentAnswer::where('student_id', Auth::id())
            ->where('exam_id', $exam->id)
            ->where('question_id', $currentQuestion->id)
            ->first();

        return view('examDashboard.show', compact(
            'exam',
            'currentQuestion',
            'questionIndex',
            'totalQuestions',
            'savedAnswer'
        ));
    }


    public function storeAnswer(Request $request, $examId, $questionIndex)
    {
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

    
     
}
