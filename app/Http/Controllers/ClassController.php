<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teachers;
use App\Models\Classes;

class ClassController extends Controller
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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * TODO: Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // TODO: validate input
            $validate = $request->validate([
                'name' => 'required|string|max:255|unique:classes',
                // Add more validation rules for other form fields
            ]);


            // TODO: store class to datebase
                $this->classes->name = $request->name;
                $this->classes->save();
            
            // TODO: return success message
            return back()->with('success', 'Class added successfully');
            // TODO: return error message
            return back()->withErrors($validatedData);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * TODO: Display the specified resource.
    */
    public function fetch_classStudents(Request $request)
    {
        try {
            // TODO: fetch students
                $response = $this->students->where('class_id', $request->class_id)->get();
            // TODO: return data
                if (count($response) > 0) {
                    return [
                        'status' => 200,
                        'data' => $response
                    ];
                }

                return [
                    'status' => 400,
                    'message' => 'Class doesn\'t have any students' 
                ];

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
