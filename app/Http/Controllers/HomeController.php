<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teachers;
use App\Models\Classes;

class HomeController extends Controller
{
    private $attendance;
    private $students;
    private $teachers;
    private $classes;
    public function __construct() {
        $this->middleware('auth');

        $this->attendance = new Attendance;
        $this->students = new Student;
        $this->teachers = new Teachers;
        $this->classes = new Classes;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            // TODO: fetch classes
                $classes = $this->attendance::join('classes', 'classes.id', '=', 'attendances.class_id')
                ->select(
                    'classes.name',
                    'classes.id',
                    \DB::raw('SUM(CASE WHEN attendances.remarks = 0 THEN 1 ELSE 0 END) AS total_absent'),
                    \DB::raw('SUM(CASE WHEN attendances.remarks = 1 THEN 1 ELSE 0 END) AS total_present'),
                    \DB::raw('SUM(CASE WHEN attendances.remarks = 2 THEN 1 ELSE 0 END) AS total_late')
                )
                ->groupBy('classes.name', 'classes.id')
                ->get();
        
                
            return view('home', compact('classes'));

        } catch (\Throwable $th) {
            throw $th;
            return view('template.404');
        }
    }
}
