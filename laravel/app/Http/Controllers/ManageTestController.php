<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StartTest;
use App\Models\Test;
use Carbon\Carbon;

class ManageTestController extends Controller
{
    public function add($id){
        $user_id = Auth::id();
        $test_id = Test::find($id);
        $data = Carbon::now();
        $time_test = Carbon::parse($test_id->time_test);

        $data_final = $data->copy()->addHours($time_test->hour)->addMinutes($time_test->minute);

        $horario_termino = $data_final->format('H:i');

        StartTest::create([
            'user_id' => $user_id,
            'test_id' => $test_id->id,
            'time_start_test' => Carbon::now()->format('H:i'),
            'time_end_test' => $horario_termino,
        ]);

        return redirect()->route('test_start', ['id' => $id]);
    }

    public function start($id)
    {
        $test_id = Test::find($id);
        $data = Carbon::now();

        $time_test = Carbon::parse($test_id->time_test);

        $data_final = $data->copy()->addHours($time_test->hour)->addMinutes($time_test->minute);

        $horario_termino = $data_final->format('H:i');

        $time_start = StartTest::where('test_id',$id)->first();
        $start_tests = ((Carbon::parse($time_start->time_end_test)->floatDiffInHours(date('H:i'))*60)*60);

        $test = Test::with('questions')->find($id);
        $data->format('H:i');

        return view('pages.start-test', compact('test', 'start_tests', 'data_final', 'data'));
    }

    public function end($id){
        $test = StartTest::find($id);
        $test->test_finish = 1;
        $test->save();
        return view ('pages.test-student');
    }

}
