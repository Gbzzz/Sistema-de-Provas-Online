<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    public function storeOpen(Request $request)
    {
       $data = $request->validate([
        'tag' => 'required|string',
        'enunciado' => 'required|string',
        'answer' => 'required|string',
        'tipoQuestao' => 'required|integer',
       ]);

        Question::create($data);

        $message = "Questão Cadastrada";
        Session::flash('message', $message);
        return redirect()->back();
    }

    public function storeMark(Request $request){
        $question = Question::create([
            'tag'=>$request->input('tag'),
            'enunciado'=>$request->input('enunciado'),
            'tipoQuestao'=>$request->input('tipoQuestao'),
        ]);

        $answers = $request->input('answer');
        // verificando se correta está setado, se estiver atribuo true a ele
        foreach ($answers as $key => $value) {
            if(isset($value['correto']))
                $answers[$key]['correto'] = true;
        }

        // associando as respostas a pergunta
        $question->answers()->createMany($answers);

        $message = "Questão criada com Sucesso";
        Session::flash('message', $message);
        return redirect()->back();
    }

    public function list()
    {
        $questions = Cache::get('questions');

        if ($questions === null) {
            sleep(5);
            $questions = Question::get();
            Cache::put('questions', $questions);
        }

        return view('pages.index-questions', compact('questions'));
    }


    public function edit($id)
    {
        $question = Question::find($id);
        $question->answers;
        return view('pages.edit-questions', compact('question'));
    }

    public function updateQuestionOpen(Request $request, $id)
    {
        $questions = Question::find($id);
        $questions->tag = $request->input('tag');
        $questions->enunciado = $request->input('enunciado');
        $questions->answer = $request->input('answer');
        $questions->save();
        $message = "A Questão foi editada";
        Session::flash('message', $message);
        return redirect('/index-questions');
    }

    public function updateQuestionMark(Request $request, $id)
    {
        Cache::forget('questions');

        $question = Question::findOrFail($id);

        // Atualizando os dados da tabela principal
        $question->tag = $request->input('tag');
        $question->enunciado = $request->input('enunciado');
        $question->save();

        $answers = $request->input('answers');

        foreach ($answers as  $answerData) {
            // procurando as respostas relacionadas a questão
            $answer = Answer::findOrFail($answerData['id']);
            // Atualiza os campos de descrição e correto na tabela de respostas
            $answer->descricao = $answerData['descricao'];
            $answer->correto = isset($answerData['correto']) ? $answerData['correto'] : 0;
            $answer->save();
        }

        $message = "A Questão foi editada";
        Session::flash('message', $message);

        return redirect('/questions/list');
    }

    public function delete($id)
    {
        $questions = Question::find($id);
        $questions->delete();
        $message = "A Questão $questions->id foi deletada";
        Session::flash('message', $message);
        return redirect()->back();
    }

}
