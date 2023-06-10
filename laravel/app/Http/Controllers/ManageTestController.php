<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StartTest;
use App\Models\EndTest;
use App\Models\Test;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class ManageTestController extends Controller
{
    public function add($id)
    {
        $test_finish = EndTest::where('test_id', $id)->where('user_id', Auth::id())->first();

        if($test_finish){
            if ($test_finish->test_finish == 1 and $test_finish->user_id == Auth::id()) {
                $message = "Essa prova já foi finalizada, aguarde seu professor corrigi-la.";
                Session::flash('message', $message);
                return redirect('/tests');
            }
        }

        $user = Auth::user();
        $test = Test::find($id);

        $data = Carbon::now();
        $time_test = Carbon::parse($test->time_test);

        $data_final = $data->copy()->addHours($time_test->hour)->addMinutes($time_test->minute);
        $horario_termino = $data_final->format('H:i');

        $startTest = new StartTest();
        $startTest->user()->associate($user);
        $startTest->test()->associate($test);
        $startTest->time_start_test = Carbon::now()->format('H:i');
        $startTest->time_end_test = $horario_termino;
        $startTest->save();

        Log::info($user->name . ' Prova ' . $test->id . ' foi iniciada pelo usuário: ' . $user->username);

        return redirect()->route('test_start', ['id' => $id]);
    }


    public function start($id)
    {
        $test_id = Test::find($id);
        $data = Carbon::now();
        $time_test = Carbon::parse($test_id->time_test);
        $data_final = $data->copy()->addHours($time_test->hour)->addMinutes($time_test->minute);
        $time_start = StartTest::where('test_id', $id)->where('user_id', Auth::id())->first();
        $end_time = Carbon::parse($time_start->time_end_test);
        $cont_test = $end_time->diffInSeconds($data);
        $test = Test::with('questions')->find($id);

        return view('pages.start-test', compact('test', 'cont_test'));
    }


    public function end($id){

        $user = Auth::user();
        $test = Test::find($id);
        $endTest =  new EndTest();
        $endTest->test_finish = 1;
        $endTest->user()->associate($user);
        $endTest->test()->associate($test);
        $endTest->save();
        $message = "O tempo da prova acabou :(";
        Session::flash('message', $message);
        return redirect('/tests');
    }

}
