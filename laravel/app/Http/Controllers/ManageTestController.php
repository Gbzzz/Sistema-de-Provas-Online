<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StartTest;
use App\Models\Test;
use Carbon\Carbon;

class ManageTestController extends Controller
{
    public function index(Request $request, $id)
    {

        $user_id = Auth::id();
        $test_id = Test::find($id);
        $data = Carbon::now();
        $time_test = Carbon::parse($test_id->time_test);

        $data_final = $data->copy()->addHours($time_test->hour)->addMinutes($time_test->minute);

        $time_start = StartTest::create([
            'user_id' => $user_id,
            'test_id' => $test_id->id,
            'time_start_test' => $data->format('H:s'),
            'time_end_test' => $data_final->format('H:s'),
        ]);

        $test = Test::with('questions')->find($id);
        $start_tests = StartTest::where('user_id', $user_id)->first();

        return view('pages.start-test', compact('test', 'start_tests', 'data_final'));
    }

}
