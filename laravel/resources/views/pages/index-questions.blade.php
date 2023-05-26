@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Questões'])
    <div class="container-fluid py-4">
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Questões</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center ">
                            <tbody>
                                @foreach($questions as $question)
                                <tr>
                                    <td>
                                        <div class="d-flex py-1 align-items-center mt-2">
                                            <div class="icon icon-shape icon-sm  bg-gradient-dark shadow text-center">
                                                <i class="ni ni-tag text-white opacity-10"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-3">Tag</p>
                                            <h6 class="text-sm mb-0">{{ $question->tag }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-3">Enunciado</p>
                                            <h6 class="text-sm mb-0">{{ $question->enunciado }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{ route('edit_question', ['id' => $question->id]) }}" method="POST">
                                            @csrf
                                                <button type="submit" class="btn btn-primary btn-sm mt-4">Editar</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="/questions/delete/{{$question->id}}" method="POST">
                                            @csrf
                                            @method('delete')
                                                <button type="submit" class="btn btn-primary btn-sm mt-4">Deletar</button>
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
                    <div class="card-header pb-0 p-4">
                        <h6 class="mt-1">Criar Questão</h6>
                    </div>
                    <div class="card-body p-2">
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="card-header pb-0">
                                    <div class="align-items-center">
                                        <button type="submit" class="btn btn-primary btn-sm ms-auto mx-2" data-toggle="modal" data-target="#aberta-Modal">Questão Aberta</button>
                                        <button type="submit" class="btn btn-primary btn-sm ms-auto mx-2" data-toggle="modal" data-target="#uma-correta-Modal">Questão com 1 Correta</button>
                                        <button type="submit" class="btn btn-primary btn-sm ms-auto mx-2" data-toggle="modal" data-target="#v-f-Modal">Questão de V/F</button>
                                        <button type="submit" class="btn btn-primary btn-sm ms-auto mx-2" data-toggle="modal" data-target="#multipla-escolha-Modal">Questão de Múltipla Escolha</button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

         <!-- Modal Aberta -->
         <div class="modal fade" id="aberta-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Questão Aberta</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('add_questionOpen') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tag</label>
                                <input name="tag" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Enunciado</label>
                                <input name="enunciado" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Resposta</label>
                                <input name="answer" type="text" class="form-control" id="exampleInputPassword1" placeholder="..." required>
                            </div>

                            <input type="hidden" name="tipoQuestao" value="1">

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm mx-2" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary btn-sm">Criar questão</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Aberta -->

        <!-- Modal V/F -->
        <div class="modal fade" id="v-f-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Questão de V/F</h5>
                    </div>
                    <form action="{{ route('add_questionMark') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tag</label>
                                <input name="tag" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Enunciado</label>
                                <input name="enunciado" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-end mb-2">
                                <input name="answer[0][correto]" class="form-check-input me-2" type="checkbox" id="exampleCheck1" value="true">
                                <input name="answer[0][descricao]" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-end mb-2">
                                <input name="answer[1][correto]" class="form-check-input me-2" type="checkbox" id="exampleCheck2" value="true">
                                <input name="answer[1][descricao]" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-end mb-2">
                                <input name="answer[2][correto]" class="form-check-input me-2" type="checkbox" id="exampleCheck3" value="true">
                                <input name="answer[2][descricao]" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-end mb-2">
                                <input name="answer[3][correto]" class="form-check-input me-2" type="checkbox" id="exampleCheck4" value="true">
                                <input name="answer[3][descricao]" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-end mb-2">
                                <input name="answer[4][correto]" class="form-check-input me-2" type="checkbox" id="exampleCheck5" value="true">
                                <input name="answer[4][descricao]" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                            </div>

                            <input type="hidden" name="tipoQuestao" value="2">

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm mx-2" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary btn-sm">Criar questão</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal V/F -->

         <!-- Modal Multipla Escolha -->
<div class="modal fade" id="multipla-escolha-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Questão de Multipla Escolha</h5>
            </div>
            <form action="{{ route('add_questionMark') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tag</label>
                        <input name="tag" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enunciado</label>
                        <input name="enunciado" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                    </div>
                    <div class="form-check d-flex align-items-center justify-content-end mb-2">
                        <input name="answer[0][correto]" class="form-check-input me-2" type="checkbox" id="exampleCheck1" value="true">
                        <input name="answer[0][descricao]" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                    </div>
                    <div class="form-check d-flex align-items-center justify-content-end mb-2">
                        <input name="answer[1][correto]" class="form-check-input me-2" type="checkbox" id="exampleCheck2" value="true">
                        <input name="answer[1][descricao]" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                    </div>
                    <div class="form-check d-flex align-items-center justify-content-end mb-2">
                        <input name="answer[2][correto]" class="form-check-input me-2" type="checkbox" id="exampleCheck3" value="true">
                        <input name="answer[2][descricao]" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                    </div>
                    <div class="form-check d-flex align-items-center justify-content-end mb-2">
                        <input name="answer[3][correto]" class="form-check-input me-2" type="checkbox" id="exampleCheck4" value="true">
                        <input name="answer[3][descricao]" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                    </div>
                    <div class="form-check d-flex align-items-center justify-content-end mb-2">
                        <input name="answer[4][correto]" class="form-check-input me-2" type="checkbox" id="exampleCheck5" value="true">
                        <input name="answer[4][descricao]" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                    </div>

                    <input type="hidden" name="tipoQuestao" value="3">

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm mx-2" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary btn-sm">Criar questão</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Multipla Escolha -->

<!-- Modal 1 Correta -->
<div class="modal fade" id="uma-correta-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Questão Com 1 Correta</h5>
            </div>
            <form action="{{ route('add_questionMark') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tag</label>
                        <input name="tag" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enunciado</label>
                        <input name="enunciado" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                    </div>
                    <div class="form-check d-flex align-items-center justify-content-end mb-2">
                        <input name="answer[0][correto]" class="form-check-input only-one me-2" type="checkbox" id="exampleCheck1" value="true">
                        <input name="answer[0][descricao]" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                    </div>
                    <div class="form-check d-flex align-items-center justify-content-end mb-2">
                        <input name="answer[1][correto]" class="form-check-input only-one me-2" type="checkbox" id="exampleCheck2" value="true">
                        <input name="answer[1][descricao]" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                    </div>
                    <div class="form-check d-flex align-items-center justify-content-end mb-2">
                        <input name="answer[2][correto]" class="form-check-input only-one me-2" type="checkbox" id="exampleCheck3" value="true">
                        <input name="answer[2][descricao]" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                    </div>
                    <div class="form-check d-flex align-items-center justify-content-end mb-2">
                        <input name="answer[3][correto]" class="form-check-input only-one me-2" type="checkbox" id="exampleCheck4" value="true">
                        <input name="answer[3][descricao]" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                    </div>
                    <div class="form-check d-flex align-items-center justify-content-end mb-2">
                        <input name="answer[4][correto]" class="form-check-input only-one me-2" type="checkbox" id="exampleCheck5" value="true">
                        <input name="answer[4][descricao]" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..." required>
                    </div>

                    <input type="hidden" name="tipoQuestao" value="4">

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm mx-2" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary btn-sm">Criar questão</button>
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
<!-- Modal 1 Correta -->





        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        const radiosOnlyOne = document.getElementsByClassName('only-one');

        const onlyOne = ($event)=>{
            for(let i = 0; radiosOnlyOne.length > i; i++){
                if(radiosOnlyOne[i].name != $event.name)
                radiosOnlyOne[i].checked = false;
            }
        };

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
