<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teachers;
use App\Models\Classes;
use Carbon\Carbon;
class AttendanceController extends Controller
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
     * TODO: set class attendance 
     */
        public function set_classAttendance(Request $request) {
            try {
                // TODO: validate if there are alread attendance in the current date
                    $current_date = date('Y-m-d');
                    $check_attendance = $this->attendance::whereDate('created_at', $current_date)
                    ->where('class_id', $request->class_id)->get();
                    if(count($check_attendance) > 0) {
                        return back()->with('fail', 'Attendance for this class has already been set for today');
                    }
                // TODO: setting attendace remarks per student
                    foreach ($request->student_id as $key => $value) {
                        $this->attendance::create([
                            'class_id' => $request->class_id,
                            'student_id' => $value,
                            'remarks' => $request->remarks[$key],
                            'month' => date('m'),
                            'year' => date('Y'),
                        ]);
                    }
                // TODO: return data
                    return back()->with('success', 'Attendance set successfullys');
            } catch (\Throwable $th) {
                throw $th;
            }
        }

    /**
     * TODO: get class attendance
     * * based on year and month
     */
        public function get_classAttendance(Request $request) {
            try {
                // TODO: fetch classes in attendance
                $response = $this->attendance::join('classes', 'classes.id', '=', 'attendances.class_id')
                    ->where('attendances.year', $request->year)
                    ->where('attendances.month', $request->month)
                    ->select('classes.name', 'classes.id')
                    ->groupBy('classes.name', 'classes.id')
                    ->get();

                if (count($response) > 0) {
                    return [
                        'status' => 200,
                        'data' => $response
                    ];
                }

                return [
                    'status' => 400,
                    'message' => 'No records found'
                ];
            } catch (\Throwable $th) {
                throw $th;
            }
        }

    /**
     * TODO: get class attendance
     * * based on year and month
     */
        public function view_classAttendance(Request $request) {
            try {
                // TODO: fetch classes in attendance
                $response = $this->attendance::join('students', 'students.id', 'attendances.student_id')
                    ->where('attendances.class_id', $request->class_id)
                    ->select('students.first_name', 'students.last_name', 'attendances.remarks', \DB::raw('DATE_FORMAT(attendances.created_at, "%M %d, %Y") as formatted_created_at'))
                    ->get();
            

                if (count($response) > 0) {
                    return [
                        'status' => 200,
                        'data' => $response
                    ];
                }

                return [
                    'status' => 400,
                    'message' => 'No records found'
                ];
            } catch (\Throwable $th) {
                throw $th;
            }
        }
}
