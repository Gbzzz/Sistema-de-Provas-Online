@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Editar Questão'])
    <div id="alert">
        @include('components.alert')
    </div>

    @if($question->tipoQuestao == '1')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card">
                            <form role="form" method="POST" action="{{ route('update_questionOpen', $question->id) }}">
                                @method('PUT')
                                @csrf
                                <div class="card-header pb-0">
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0">Editar Questão</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Tag</label>
                                            <input class="form-control" type="text" name="tag" value="{{ $question->tag }}">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Enunciado</label>
                                            <input class="form-control" type="text" name="enunciado" value="{{ $question->enunciado }}">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Resposta</label>
                                            <input class="form-control" type="text" name="answer" value="{{ $question->answer }}">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button type="submit" class="btn btn-primary btn-sm ms-auto">Salvar</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    @elseif($question->tipoQuestao == '2' || $question->tipoQuestao == '3')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card">
                            <form role="form" method="POST" action="{{ route('update_questionMark', $question->id) }}">
                                @method('PUT')
                                @csrf
                                <div class="card-header pb-0">
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0">Editar Questão</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Tag</label>
                                            <input class="form-control" type="text" name="tag" value="{{ $question->tag }}">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Enunciado</label>
                                            <input class="form-control" type="text" name="enunciado" value="{{ $question->enunciado }}">
                                        </div>
                                    </div>

                                        @php
                                            $letras = ['A', 'B', 'C', 'D', 'E'];
                                        @endphp

                                    <label for="example-text-input" class="form-control-label">Respostas</label>

                                    @foreach($question->answers as $index => $answer)
                                    <div>
                                        <label>Letra {{ $letras[$index] }}</label>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-1">
                                            <input type="hidden" name="answers[{{ $index }}][id]" value="{{$answer->id}}" />
                                            <div class="form-check mt-1">
                                                <input type="checkbox" name="answers[{{ $index }}][correto]" value="1" {{$answer->correto ? 'checked' : ''}} class="form-check-input">
                                            </div>
                                        </div>
                                        <div class="col-sm-11">
                                            <input name="answers[{{ $index }}][descricao]" type="text" class="form-control" value="{{ $answer->descricao }}" id="box">
                                        </div>
                                    </div>
                                    @endforeach

                                    <div class="d-flex align-items-center">
                                        <button type="submit" class="btn btn-primary btn-sm ms-auto">Salvar</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card">
                            <form role="form" method="POST" action="{{ route('update_questionMark', $question->id) }}">
                                @method('PUT')
                                @csrf
                                <div class="card-header pb-0">
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0">Editar Questão</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Tag</label>
                                            <input class="form-control" type="text" name="tag" value="{{ $question->tag }}">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Enunciado</label>
                                            <input class="form-control" type="text" name="enunciado" value="{{ $question->enunciado }}">
                                        </div>
                                    </div>

                                        @php
                                            $letras = ['A', 'B', 'C', 'D', 'E'];
                                        @endphp

                                    <label for="example-text-input" class="form-control-label">Respostas</label>

                                    @foreach($question->answers as $index => $answer)
                                    <div>
                                        <label>Letra {{ $letras[$index] }}</label>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-1">
                                            <input type="hidden" name="answers[{{ $index }}][id]" value="{{$answer->id}}" />
                                            <div class="form-check mt-1">
                                                <input type="checkbox" name="answers[{{ $index }}][correto]" value="1" {{$answer->correto ? 'checked' : ''}} class="form-check-input only-one">
                                            </div>
                                        </div>
                                        <div class="col-sm-11">
                                            <input name="answers[{{ $index }}][descricao]" type="text" class="form-control" value="{{ $answer->descricao }}" id="box">
                                        </div>
                                    </div>
                                    @endforeach

                                    <div class="d-flex align-items-center">
                                        <button type="submit" class="btn btn-primary btn-sm ms-auto">Salvar</button>
                                    </div>
                                </div>
                            </form>

                            <script>
                                // Função para desmarcar outros checkboxes quando um for marcado
                                document.querySelectorAll('.only-one').forEach(function(checkbox) {
                                    checkbox.addEventListener('change', function() {
                                        if (this.checked) {
                                            document.querySelectorAll('.only-one').forEach(function(otherCheckbox) {
                                                if (otherCheckbox !== checkbox) {
                                                    otherCheckbox.checked = false;
                                                }
                                            });
                                        }
                                    });
                                });
                            </script>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
