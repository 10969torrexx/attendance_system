<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teachers;
use App\Models\Classes;

class StudentsPagesController extends Controller
{
    private $students;
    private $teachers;
    private $classes;
    public function __construct() {
        $this->students = new Student;
        $this->teachers = new Teachers;
        $this->classes = new Classes;
    }

   /**
     * TODO: show add students page
     */
    public function show_addStudents() {
        try {
            return view('pages.students.show-addStudents');
        } catch (\Throwable $th) {
            //throw $th;
            return view('template.404');
        }
    }

    /**
     * TODO: show view teachers page
     */
    public function show_viewStudents() {
        try {
            // TODO: fetch teachers
                $students = $this->students->get();
                return view('pages.students.show-viewStudents',
                    compact('students')
                );
        } catch (\Throwable $th) {
            // throw $th;
            return view('template.404');
        }
    }

    /**
     * TODO: show view teachers page
     */
    public function show_assignStudentClass() {
        try {
            // TODO: fetch students
                $students = $this->students->where('with_class', 0)->get();
            // TODO: fetch classes
                $classes = $this->classes->get();
            return view('pages.students.show-assignStudentClass',
                compact('students', 'classes')
            );
        } catch (\Throwable $th) {
            // throw $th;
            return view('template.404');
        }
    }
}
