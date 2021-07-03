@extends('main')

@section('content')
    <div class="flex flex-wrap mt-3">
        <div class="w-full lg:mt-0 pr-0 lg:pr-2">
            <p class="text-xl pb-3 flex items-center"> Main chart </p>
            <div class="p-6 rounded shadow bg-white">
                <canvas id="chartOne" width="400" height="80"></canvas>
                <canvas id="chartOne" width="400" height="80"></canvas>
            </div>
        </div>

        <div class="w-full mt-5 lg:w-1/2 pr-0 lg:pr-2">
            <p class="text-xl pb-3 flex items-center">
                Pizza chart
            </p>
            <div class="p-6 rounded shadow bg-white">
                <canvas id="chartOne" width="400" height="200"></canvas>
            </div>
        </div>

        <div class="w-full mt-5 lg:w-1/2 pr-0 lg:pr-2">
            <p class="text-xl pb-3 flex items-center">
                Last calls
            </p>
            <div class="p-6 rounded shadow bg-white">
                <canvas id="chartOne" width="400" height="200"></canvas>
            </div>
        </div>


        <div class="w-full lg:mt-0 pr-0 lg:pr-2">
            <p class="text-xl mt-5 pb-3 flex items-center">
                Last calls
            </p>
            <div class="p-6 rounded shadow bg-white">
                <canvas id="chartOne" width="400" height="200"></canvas>
            </div>
        </div>

    </div>
@endsection

@section('javascript')
    <script>
        var chartOne = document.getElementById('chartOne');
        var myChart = new Chart(chartOne, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var chartTwo = document.getElementById('chartTwo');
        var myLineChart = new Chart(chartTwo, {
            type: 'line',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
