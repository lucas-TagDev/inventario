@extends('layout.app')
@section('content')
                   
<h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Painel de Controle</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total de Dispositivos</div>
                <center><h1>{{ $projects->count() }}</h1></center>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body"><img src="https://www.svgrepo.com/show/2086/laptop.svg" width="40px"> Notebooks</div>
                <center><h1>{{ $filterData->count() }}</h1></center>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body"><img src="https://www.svgrepo.com/show/95219/desktop.svg" width="40px"> Desktop</div>
                <center><h1>{{ $filterData2->count() }}</h1></center>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body"><img src="https://www.svgrepo.com/show/14899/printer.svg" width="32px"> Impressoras </div>
                
                <center><h1>{{ $filterData3->count() }}</h1></center>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-secondary text-white mb-4">
                <div class="card-body"><img src="https://www.svgrepo.com/show/36915/monitor.svg" width="40px"> Monitores</div>
                <center><h1>{{ $filterData4->count() }}</h1></center>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body"><img src="https://www.svgrepo.com/show/60605/scanner.svg" width="40px"> Scanners</div>
                <center><h1>{{ $filterData5->count() }}</h1></center>
            </div>
        </div>
    </div>
    <div class="row">
        <!--
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Area Chart Example
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
            </div>
        </div>-->
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Gráfico de Equipamentos
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Gráfico de Equipamentos em Uso/Conserto/Danificado
                </div>
                <div class="card-body"><canvas id="myPieChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#292b2c';

                        // Variaveis
                        var year = <?php echo $year; ?>;

                        // Bar Chart Example
                        var ctx = document.getElementById("myBarChart");
                        var myLineChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: year,
                            datasets: [{
                            label: "Total",
                            backgroundColor: "rgba(2,117,216,1)",
                            borderColor: "rgba(2,117,216,1)",
                            data: [
                                {{ $note_count}}, {{ $desk_count}}, {{ $monitor_count}}, {{ $print_count}}, {{ $scan_count}}
                            ],
                            }],
                        },
                        options: {
                            scales: {
                            xAxes: [{
                                time: {
                                unit: 'month'
                                },
                                gridLines: {
                                display: false
                                },
                                ticks: {
                                maxTicksLimit: 6
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                min: 0,
                                max: 50,
                                maxTicksLimit: 5
                                },
                                gridLines: {
                                display: true
                                }
                            }],
                            },
                            legend: {
                            display: false
                            }
                        }
                        });
                    </script>

                    <script>
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#292b2c';

                        // Pie Chart Example
                        var ctx = document.getElementById("myPieChart");
                        var myPieChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ["Danificado", "Conserto", "Em uso"],
                            datasets: [{
                            data: [
                                {{$danificado_count}},{{$conserto_count}},{{$emuso_count}}
                            ],
                            backgroundColor: ['#dc3545', '#ffc107', '#28a745'],
                            }],
                        },
                        });
                    </script>
    <!--TABELA-->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DISPOSITIVOS CADASTRADOS
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Patrimonio</th>
                        <th>Nome</th>
                        <th>Setor</th>
                        <th>Usuario</th>
                        <th>Data de Registro</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <td>{{ $project->patri }}</td>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->setor }}</td>
                        <td>{{ $project->user }}</td>
                        <td>{{ $project->created_at }}</td>
                        <td>
                            <form action="{{ route('web.destroy', $project->id) }}" method="POST">

                                <a href="{{ route('web.show', $project->id) }}" title="show">
                                    <i class="fas fa-eye text-success  fa-lg"></i>
                                </a>

                                <a href="{{ route('web.edit', $project->id) }}">
                                    <i class="fas fa-edit  fa-lg"></i>

                                </a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                    <i class="fas fa-trash fa-lg text-danger"></i>

                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
