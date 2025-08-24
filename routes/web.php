<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\stdSessionController;

Route::controller(SessionController::class)->group(function(){
    Route::get('/', [SessionController::class, 'create'])->name('login');  
    Route::post('/userlogin', [SessionController::class, 'store'])->name('userlogin');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin-dashboard', [UserController::class, 'index'])->name('admin.dashboard');
    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

    Route::get('/add-student', [StudentController::class, 'index'])->name('add-student');
    Route::post('/add-student', [StudentController::class, 'store'])->name('add-student');
    Route::get('/staff/get-lgas/{state_id}', [StudentController::class, 'getLgas']); 
    // Route::get('/staff/student/get-departments/{school_id}', [StudentController::class, 'get_Departments'] ); //ajax
    Route::get('/get-departments/{school_id}', [StudentController::class, 'get_Departments']);
    Route::get('/get-department-code/{department_id}', [StudentController::class, 'getDepartmentCode']);

    Route::get('/add-school', [SchoolController::class, 'index'])->name('add-school');
    Route::post('/add-school', [SchoolController::class, 'store'])->name('add-school');

    Route::get('/add-course', [CourseController::class, 'index'])->name('add-course');
    Route::post('/add-course', [CourseController::class, 'store'])->name('add-course');
    Route::get('/manage-course', [CourseController::class, 'show'])->name('manage-course');

    Route::get('/add-question', [QuestionController::class, 'index'])->name('add-question');

    Route::get('/add-questions/{course}', [QuestionController::class, 'create'])->name('add-questions');
    Route::post('/add-questions', [QuestionController::class, 'store'])->name('add-questions');
    Route::get('/view-questions', [QuestionController::class, 'show'])->name('view.question');

    Route::get('/add-exam', [ExamController::class, 'create'])->name('exam.create');
    Route::post('/add-exam', [ExamController::class, 'store'])->name('exam.create');
    Route::get('/view-exam', [ExamController::class, 'show'])->name('exam.show');

});

// student 

Route::get('/students-login', [stdSessionController::class, 'show']);//->name('view-students');   
Route::post('/student-login', [stdSessionController::class, 'store'])->name('studentlogin');  

Route::middleware(['web', 'auth:student'])->group(function () {
    Route::get('/student-dashboard', [stdSessionController::class, 'index'])->name('student.dashboard');    
});