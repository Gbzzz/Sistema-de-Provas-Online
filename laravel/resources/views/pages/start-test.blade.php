@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-1 mt-3">
                <div class="card">
                    <div class="text-center align-middle">
                        <div id="contador"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($test->questions as $question)
        @if($question->tipoQuestao == '1')
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div class="card mt-3">
                                <form role="form">
                                    <div class="card-header pb-0">
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0">{{ $question->enunciado }}</p>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Resposta</label>
                                                <input class="form-control" type="text" name="answer">
                                            </div>
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
                        <div class="card mt-3">
                                <form role="form">
                                    <div class="card-header pb-0">
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0">{{ $question->enunciado }}</p>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                            @php
                                                $letras = ['A', 'B', 'C', 'D', 'E'];
                                            @endphp

                                        @foreach($question->answers as $index => $answer)
                                        <div>
                                            <label>Letra {{ $letras[$index] }}</label>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-1">
                                                <input type="hidden" name="answers[{{ $index }}][id]" value="{{$answer->id}}" />
                                                <div class="form-check mt-2">
                                                    <input type="checkbox" name="answers[{{ $index }}][correto]" value="1" class="form-check-input">
                                                </div>
                                            </div>
                                            <div class="col-sm-11">
                                                <input name="answers[{{ $index }}][descricao]" type="text" class="form-control" value="{{ $answer->descricao }}" id="box">
                                            </div>
                                        </div>
                                        @endforeach
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
                        <div class="card mt-3">
                                <form role="form">
                                    @csrf
                                    <div class="card-header pb-0">
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0">{{ $question->enunciado }}</p>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                            @php
                                                $letras = ['A', 'B', 'C', 'D', 'E'];
                                            @endphp



                                        @foreach($question->answers as $index => $answer)
                                        <div>
                                            <label>Letra {{ $letras[$index] }}</label>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-1">
                                                <input type="hidden" name="answers[{{ $index }}][id]" value="{{$answer->id}}" />
                                                <div class="form-check mt-1">
                                                    <input type="checkbox" name="answers[{{ $index }}][correto]" value="1" class="form-check-input only-one">
                                                </div>
                                            </div>
                                            <div class="col-sm-11">
                                                <input name="answers[{{ $index }}][descricao]" type="text" class="form-control" value="{{ $answer->descricao }}" id="box">
                                            </div>
                                        </div>
                                        @endforeach

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
    @endforeach
    <form action="">
        <div class="align-items-center mt-5">
            <div class="me-12 text-end">
                <button type="submit" class="btn btn-primary btn-sm">Enviar Resposta</button>
            </div>
        </div>
    </form>
@endsection

