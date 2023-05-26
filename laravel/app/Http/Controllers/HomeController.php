<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Test;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $questions = Question::get();
        $tests = Test::get();
        return view('pages.dashboard', compact('questions', 'tests'));
    }

    public function index_tests()
    {
        $questions = Question::get();
        $tests = Test::get();
        return view('pages.index-tests', compact('questions', 'tests'));
    }

    public function index_questions(){

        $questions = Question::get();
        return view('pages.index-questions', compact('questions'));
    }
}
