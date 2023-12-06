<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * TODO: show dashboad page for website
     */
    public function index() {
        try {
            // * show dashboard page
                return view('template.dashboard');
        } catch (\Throwable $th) {
            //throw $th;
            return view('template.404');
        }
    }
}
