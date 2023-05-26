@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Editar Questão'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Editar Questão</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Tag</label>
                                    <input class="form-control" type="text" name="tag" value="{{ $question->tag }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Enunciado</label>
                                    <input class="form-control" type="text" name="enunciado" value="{{ $question->enunciado }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-8 ">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Resposta</label>
                                    <input class="form-control" type="text" name="answer" value="{{ $question->answer }}" disabled>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Voltar</button>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
@endsection
