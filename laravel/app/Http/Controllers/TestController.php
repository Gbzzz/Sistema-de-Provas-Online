<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{

    public function index(){
        $tests = Test::get();
        return view('pages.test-student', compact('tests'));
    }
    public function store(Request $request)
    {
        $test = Test::create([
            'date_start' => $request->input('date_start'),
            'date_end' => $request->input('date_end'),
            'time_test' => $request->input('time_test'),
            'dsc_test' => $request->input('dsc_test'),
        ]);

        // obter os IDs das perguntas selecionadas
        $selectedIds = $request->id;

        foreach($selectedIds as $selectedId){
            $test->questions()->attach($selectedId);
        }

        return redirect('/index-tests')->with('success-message', 'Prova criada com sucesso!');
    }

    public function delete($id){
        $test = Test::find($id);
        $test->delete();
        return redirect('/index-tests');
    }
}
