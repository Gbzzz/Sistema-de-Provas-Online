@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Provas'])
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-9">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Suas provas</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center ">
                                <tbody>
                                    @foreach($tests as $test)
                                    <tr>
                                        <td>
                                            <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-2">Data de Início</p>
                                                <h6 class="text-sm mb-0">{{ date('d/m/Y', strtotime($test->date_start)) }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-2">Data de Finalização</p>
                                                <h6 class="text-sm mb-0">{{ date('d/m/Y', strtotime($test->date_end)) }}</h6>
                                            </div>
                                        </td>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-2">Tempo de prova</p>
                                                <h6 class="text-sm mb-0">{{ $test->time_test }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-2">Descrição da Prova</p>
                                                <h6 class="text-sm mb-0">{{ $test->dsc_test }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <form action="/tests/start/{{$test->id}}" method="GET">
                                                    <button type="submit" class="btn btn-primary btn-sm mt-4">Começar</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
