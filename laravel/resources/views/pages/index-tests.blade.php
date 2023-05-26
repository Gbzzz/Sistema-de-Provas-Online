@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Questões'])
    <div class="container-fluid py-4">

        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Provas</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center ">
                            <tbody>
                                @foreach($tests as $test)
                                <tr>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="icon icon-shape icon-sm  bg-gradient-dark shadow text-center">
                                                <i class="ni ni-tag text-white opacity-10"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Data de Início</p>
                                            <h6 class="text-sm mb-0">{{ date('d/m/Y', strtotime($test->date_start)) }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Data de Finalização</p>
                                            <h6 class="text-sm mb-0">{{ date('d/m/Y', strtotime($test->date_end)) }}</h6>
                                        </div>
                                    </td>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Tempo</p>
                                            <h6 class="text-sm mb-0">{{ $test->time_test }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Descrição da Prova</p>
                                            <h6 class="text-sm mb-0">{{ $test->dsc_test }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="/tests/delete/{{$test->id}}" method="POST">
                                            @csrf
                                            @method('delete')
                                                <button type="submit" class="btn btn-primary btn-sm mt-3">Deletar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Criar Prova</h6>
                    </div>
                    <div class="card-body p-3">
                        <form action="{{ route('add_test') }}" method="POST">
                            @csrf
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex justify-content-between border-radius-lg">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label text-left">Data Início</label>
                                                <input class="form-control" type="date" name="date_start">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label text-left">Data Fim</label>
                                                <input class="form-control" type="date" name="date_end">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label text-left">Tempo de prova</label>
                                                <input class="form-control" type="time" name="time_test">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label text-left">Descrição da Prova</label>
                                                <input class="form-control" type="text" name="dsc_test">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <label for="example-text-input" class="form-control-label">Selecione as questões da prova:</label>
                            <div class="table-responsive">
                                <table class="table align-items-center">
                                    <tbody>
                                        @foreach($questions as $question)
                                        <tr>
                                            <td>
                                                <div class="form-check d-flex align-items-center justify-content-end mb-2">
                                                    <input name="id[]" class="form-check-input only-one me-2 mt-3" type="checkbox" id="exampleCheck3" value="{{ $question->id }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">Enunciado</p>
                                                    <h6 class="text-sm mb-0">{{ $question->enunciado }}</h6>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Criar Prova</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#fb6340",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endpush
