<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;

class ManageTestController extends Controller
{
    public function index(Request $request, $id){

        $time_start = Test::find($id);
        $data = date('Y-m-d h:i');
        $time_start->time_start_test = $data;
        $time_start->save();

        $test = Test::with('questions')->find($id);

        return view('pages.start-test', compact('test'));
    }

    public function start(){

    }
}
