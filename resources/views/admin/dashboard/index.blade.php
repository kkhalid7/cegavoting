@extends('admin.master')

@section('content')
    <div class="container-fluid">
        <div class="mb-2">
            <h4 class="m-0 text-gray-dark">Voting Results</h4>
        </div>
        <div class="row">
            @if(!empty($votes))
                @foreach($votes as $type=>$vote)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">{{implode(' ', explode('_', strtoupper($type)))}}</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart-{{$type}}" data-values="{{json_encode(array_values($vote))}}"
                                        data-labels="{{json_encode(array_keys($vote))}}" class="chart"></canvas>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    </div>
@endsection

@section('js')
    <script>
        let dynamicColors = (data) => {
            let colors = [];
            for (let i in data) {
                let r = Math.floor(Math.random() * 255);
                let g = Math.floor(Math.random() * 255);
                let b = Math.floor(Math.random() * 255);
                let generatedColor = "rgb(" + r + "," + g + "," + b + ")";
                colors.push(generatedColor);
            }
            return colors;
        };
        let mode = 'index'
        let intersect = true

        let ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        let options = {
            animation: {
                duration: 0 // general animation time
            },
            hover: {
                mode: mode,
                intersect: intersect,
                animationDuration: 0 // duration of animations when hovering an item
            },
            responsiveAnimationDuration: 0, // animation duration after a resize
        };
        let createCharts = function () {
            $.ajax({
                url: "/chart-data",
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    for (let chart in data) {
                        let values = Object.values(data[chart]);
                        let labels = Object.keys(data[chart]);
                        let chartId = $(`#myChart-${chart}`);
                        drawCharts(chartId, values, labels);
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }

        let drawCharts = (chart, data, labels) => {
            new Chart(chart, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            data: data,
                            backgroundColor: dynamicColors(data)
                        },
                    ],
                },
                options: options
            });
        }

        createCharts();
        setInterval(() => {
            createCharts();
        }, 2 * 1000);
    </script>
@endsection
