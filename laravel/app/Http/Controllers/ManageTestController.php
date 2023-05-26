<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StartTest;
use App\Models\Test;
use App\Models\User;

class ManageTestController extends Controller
{
    public function index(Request $request, $id){

        $user_id = Auth::id();
        $test_id = Test::find($id);
        $data = date('h:i');

        $time_start = StartTest::create([
            'user_id' => $user_id,
            'test_id' => $test_id->id,
            'time_start_test' => $data,
        ]);
        
        $test = Test::with('questions')->find($id);
        $start_tests = StartTest::where('user_id', $user_id)->first();
        return view('pages.start-test', compact('test', 'start_tests'));
    }

}
