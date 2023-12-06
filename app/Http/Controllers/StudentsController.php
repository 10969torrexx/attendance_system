<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teachers;
use App\Models\Classes;

class StudentsController extends Controller
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
     * TODO: Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // TODO: validate input
                $validate = $request->validate([
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'birth_date' => 'required|date',
                    // Add more validation rules for other form fields
                ]);
            // TODO: store student
                $this->students->first_name = $request->first_name;
                $this->students->last_name = $request->last_name;
                $this->students->birth_date = $request->birth_date;
                $this->students->save();
            // TODO: return success message
                return back()->with('success', 'Student added successfully');
            // TODO: return error message
                return back()->withErrors($validatedData);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * TODO: this will fetch specified teacher
     */
    public function fetch_students(Request $request)
    {
        try {
            // TODO": fetch teacher
                $response = $this->students->where('id', $request->id)->first();
            // TODO: return data
                if ($response != null) {
                    return [
                        'status' => 200,
                        'data' => $response
                    ];
                }

                return [
                    'status' => 400,
                    'message' => 'Student can\'t be found' 
                ];
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * TODO: assign class to student
     */
    public function assign_studentClass(Request $request)
    {
        try {
            // TODO: validate
                $validate = $request->validate([
                    'student_id' => 'required',
                    'class_id' => 'required',
                ]);
            // TODO: assign teacher to class
                $this->students->where('id', $request->student_id)
                    ->update([
                        'with_class' => 1,
                        'class_id' => $request->class_id
                    ]);
            
            // TODO: return success message
                return back()->with('success', 'Assigning of student to class was successful');
            // TODO: return error message
                return back()->withErrors($validatedData);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
