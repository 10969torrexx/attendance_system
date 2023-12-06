<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClassPagesController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\TeachersPagesController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\StudentsPagesController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\AttendancePagesController;
use App\Http\Controllers\AttendanceController;

/**
 * TODO: show login page
 */
Route::get('/', function () {
   return view('auth.login');
});


/**
 * * these are laravel ui routes
 */
Auth::routes();

/**
 * ? routes for accessing web app functions
 */
Route::middleware(['auth'])->group(function () {
   // TODO: show-dashboard page
      Route::get('/home', [HomeController::class, 'index'])->name('home');
   # classes
      // TODO: show add class page
      Route::get('show-addClass', [ClassPagesController::class, 'show_addClass'])->name('show_addClass');
      // TODO: add class
      Route::post('add-class', [ClassController::class, 'store'])->name('add_class');
      // TODO: show view classes page
      Route::get('show-viewClass', [ClassPagesController::class, 'show_viewClass'])->name('show_viewClass');
   # end classes
   # teachers
      // TODO: show add teachers
      Route::get('show-addTeachers', [TeachersPagesController::class, 'show_addTeachers'])->name('show_addTeachers');
      // TODO: add teachers
      Route::post('add-teachers', [TeachersController::class, 'store'])->name('add_teachers');
      // TODO: view teachers
      Route::get('show-viewTeachers', [TeachersPagesController::class, 'show_viewTeachers'])->name('show_viewTeachers');
      
      // TODO: show assign section 
      Route::get('show-assignClass', [TeachersPagesController::class, 'show_assignClass'])->name('show_assignClass');
      // TODO: fetch specified teacher
      Route::get('fetch-teacher', [TeachersController::class, 'fetch_teacher'])->name('fetch_teacher');
      // TODO: assign section
      Route::post('assign-class', [TeachersController::class, 'assign_class'])->name('assign_class');
   # end teachers
   # students
      // TODO: show add students page
      Route::get('show-addStudents', [StudentsPagesController::class, 'show_addStudents'])->name('show_addStudents');
      // TODO: add students
      Route::post('add-student', [StudentsController::class, 'store'])->name('add_students');
      // TODO: show view students page
      Route::get('show-viewStudents', [StudentsPagesController::class, 'show_viewStudents'])->name('show_viewStudents');
      // TODO: show assign student class page
      Route::get('show-assignStudentClass', [StudentsPagesController::class, 'show_assignStudentClass'])->name('show_assignStudentClass');
      // TODO: fetch specified student
      Route::get('fetch-student', [StudentsController::class, 'fetch_students'])->name('fetch_students');
      // TODO: assign section
      Route::post('assign-studentClass', [StudentsController::class, 'assign_studentClass'])->name('assign_studentClass');
   # end students
   # attendance
      // TODO: set attendance
      Route::get('show-setAttendance', [AttendancePagesController::class, 'show_setAttendance'])->name('show_setAttendance');
      // TODO: fetch students of specified class
      Route::get('fetch-classStudents', [ClassController::class, 'fetch_classStudents'])->name('fetch_classStudents');   
      // TODO: fetch students of specified class
      Route::post('set-classAttendance', [AttendanceController::class, 'set_classAttendance'])->name('set_classAttendance');   
      
      // TODO: show view attendance
      Route::get('set-viewAttendance', [AttendancePagesController::class, 'show_viewAttendance'])->name('show_viewAttendance');   
      // TODO: get class in attendace based on month and year
      Route::get('get-classAttendance', [AttendanceController::class, 'get_classAttendance'])->name('get_classAttendance');   
      // TODO: view class attendance
      Route::get('view-classAttendance', [AttendanceController::class, 'view_classAttendance'])->name('view_classAttendance');   
   # end attendance

});
