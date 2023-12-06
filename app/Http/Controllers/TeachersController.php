<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Teachers;
use App\Models\Classes;

class TeachersController extends Controller
{
    private $teachers;
    private $classes;
    public function __construct() {
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
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                // Add more validation rules for other form fields
            ]);


            // TODO: store class to datebase
                $this->teachers->first_name = $request->first_name;
                $this->teachers->last_name = $request->last_name;
                $this->teachers->save();
            
            // TODO: return success message
            return back()->with('success', 'Teacher added successfully');
            // TODO: return error message
            return back()->withErrors($validatedData);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * TODO: assign section to teacher
     */
    public function assign_class(Request $request)
    {
        try {
            // TODO: validate
                $validate = $request->validate([
                    'teacher_id' => 'required',
                    'class_id' => 'required',
                ]);
            // TODO: assign teacher to class
                $this->classes->where('id', $request->class_id)
                    ->update([
                        'teacher_id' => $request->teacher_id
                    ]);
            // TODO: update teacher "with class" status
                $this->teachers->where('id', $request->teacher_id)
                    ->update([
                        'with_class' => 1
                    ]);
            // TODO: return success message
                return back()->with('success', 'Assigning Teacher to Class was successfull');
            // TODO: return error message
                return back()->withErrors($validatedData);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * TODO: this will fetch specified teacher
     */
    public function fetch_teacher(Request $request)
    {
        try {
            // TODO": fetch teacher
                $response = $this->teachers->where('id', $request->id)->first();
            // TODO: return data
                if ($response != null) {
                    return [
                        'status' => 200,
                        'data' => $response
                    ];
                }

                return [
                    'status' => 400,
                    'message' => 'Teacher can\'t be found' 
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
