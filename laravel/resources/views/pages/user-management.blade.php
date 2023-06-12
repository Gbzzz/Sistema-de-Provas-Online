@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Usuários Cadastrados'])
    <script>
        @if(Session::has('message'))
            var message = "{{ Session::get('message') }}";
            Swal.fire({
                icon: 'success',
                title: message,
                customClass: {
                    confirmButton: 'btn btn-primary btn-sm mt-4'
                }
            });
        @endif
    </script>
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Usuários</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">

                    <div id="alert">
                        @include('components.alert')
                    </div>

                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nome
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Função
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Data e Hora de Criação
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div
                                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                                <i class="ni ni-single-02 text-dark text-sm opacity-10 mb-2"></i>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">
                                                    {{ $user->username }}
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">
                                            @if ($user->admin == 1)
                                                Administrador
                                            @elseif ($user->docente == 1)
                                                Professor
                                            @else
                                                Aluno
                                            @endif
                                        </p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-sm font-weight-bold mb-0">
                                            {{ date('d/m/Y | H:i:s', strtotime($user->created_at)) }}
                                        </p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <form action="{{ route('register') }}">
                            <div class="d-flex align-items-center">
                                <button class="btn btn-primary btn-sm ms-auto" data-toggle="modal" data-target="#uma-correta-Modal" style="margin-right: 40px; margin-top: 5px">
                                    Adicionar Novo Usuário
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
