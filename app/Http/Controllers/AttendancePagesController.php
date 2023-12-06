<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teachers;
use App\Models\Classes;
class AttendancePagesController extends Controller
{
    private $attendance;
    private $students;
    private $teachers;
    private $classes;
    public function __construct() {
        $this->attendance = new Attendance;
        $this->students = new Student;
        $this->teachers = new Teachers;
        $this->classes = new Classes;
    }

    /**
     * TODO: show set attendance
     */
        public function show_setAttendance() {
            try {
                // TODO: fetch all classes
                $classes = $this->classes
                    ->leftJoin('teachers', 'teachers.id', '=', 'classes.teacher_id')
                    ->select('classes.*', \DB::raw("CONCAT(teachers.first_name, ' ', teachers.last_name) as teacher_name"))
                    // ->whereNotIn('classes.id', function($query) {
                    //     $query->select('class_id')->from('attendances');
                    // })
                    ->get();
            
                // TODO: show set attendance page
                return view('pages.attendance.show-setAttendance',
                compact('classes'));
            } catch (\Throwable $th) {
                // throw $th;
                return view('template.404');
            }
        }
    
    /**
     * TODO: show view attendance
     */
        public function show_viewAttendance() {
            try {
                // TODO: show view
                return view('pages.attendance.show-viewAttendance');
            } catch (\Throwable $th) {
                //throw $th;
                return view('template.404');
            }
        }

}
