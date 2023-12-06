<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teachers;
use App\Models\Classes;

class TeachersPagesController extends Controller
{
    private $teachers;
    private $classes;
    public function __construct() {
        $this->teachers = new Teachers;
        $this->classes = new Classes;
    }
    /**
     * TODO: show add teachers page
     */
        public function show_addTeachers() {
            try {
                return view('pages.teachers.show-addTeachers');
            } catch (\Throwable $th) {
                //throw $th;
                return view('template.404');
            }
        }
    
    /**
     * TODO: show view teachers page
     */
        public function show_viewTeachers() {
            try {
                // TODO: fetch teachers
                    $teachers = $this->teachers->get();
                    return view('pages.teachers.show-viewTeachers',
                        compact('teachers')
                    );
            } catch (\Throwable $th) {
                // throw $th;
                return view('template.404');
            }
        }

    /**
     * TODO: show assign section page
     */
        public function show_assignClass() {
            try {
                // TODO: fetch classes with no teachers
                    $classes = $this->classes->where('teacher_id', 0)->get();
                // TODO: fetch teachers with classes
                    $teachers = $this->teachers->where('with_class', 0)->get();
                return view('pages.teachers.show-assignClass', 
                    compact('classes', 'teachers'));
            } catch (\Throwable $th) {
                //throw $th;
                return view('template.404');
            }
        }
}
