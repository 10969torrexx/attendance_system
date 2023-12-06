<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teachers;
use App\Models\Classes;

class ClassPagesController extends Controller
{

    private $teachers;
    private $classes;
    public function __construct() {
        $this->teachers = new Teachers;
        $this->classes = new Classes;
    }


    /**
     * TODO: show add class page
     */
        public function show_addClass() {
            try {
                return view('pages.classes.show-addClass');
            } catch (\Throwable $th) {
                // throw $th;
                return view('template.404');
            }
        }

    /**
     * TODO: show view class page
     */
        public function show_viewClass() {
            try {
                // TODO: fetch all classes
                    $classes = $this->classes::leftJoin('teachers', 'teachers.id', '=', 'classes.teacher_id')
                    ->select('classes.*', \DB::raw("CONCAT(teachers.first_name, ' ', teachers.last_name) as teacher_name"))
                    ->get();
                // TODO: show view class page and attach data
                return view('pages.classes.show-viewClass', 
                    compact('classes'));
            } catch (\Throwable $th) {
                //throw $th;
                return view('template.404');
            }
        }
}
