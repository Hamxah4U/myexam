<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAnswer;

class StudentAnswerController extends Controller
{
   public function store(Request $request)
    {
        $request->validate([
            'exam_id' => 'required',
            'student_id' => 'required',
            'course_id' => 'required',
            'question_id' => 'required',
            'answer_id' => 'nullable',
            'navigate' => 'required',
        ]);

        StudentAnswer::updateOrCreate(
            [
                'student_id'  => $request->student_id,
                'exam_id'     => $request->exam_id,
                'course_id'   => $request->course_id,
                'question_id' => $request->question_id,
            ],
            [
                'answer_id'   => $request->answer_id,
                 'right_answe' => $request->is_correct[$request->answer_id] ?? null,
                'status'      => 'onprocess',
            ]
        );

        // If final submit, mark as completed
        if ($request->navigate === 'submit') {
            StudentAnswer::where('student_id', $request->student_id)
                ->where('exam_id', $request->exam_id)
                ->update(['status' => 'completed']);

            return redirect()->route('student.dashboard')->with('success', 'Exam submitted successfully!');
        }

        // Redirect to next or prev question
        $questionIndex = $request->current_index;

        if ($request->navigate === 'next') {
            $questionIndex++;
        } elseif ($request->navigate === 'prev') {
            $questionIndex--;
        }

        return redirect()->route('student.exams.show', [
            'examId' => $request->exam_id,
            'questionIndex' => $questionIndex,
        ]);

    }
}