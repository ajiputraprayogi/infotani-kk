@extends('layouts.home')
@section('title', 'Data Permissions')

@section('css')

@endsection

@section('content')
    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script>
        const xValues = {!! json_encode($labels) !!}; // Grup jadi label (x axis)
        const dataValues = {!! json_encode($totals) !!}; // Total per grup

        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    label: "Total per Grup",
                    data: dataValues,
                    borderColor: "blue",
                    fill: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: Math.ceil(Math.max(...dataValues)), // ⬅️ Batas atas otomatis
                        ticks: {
                            stepSize: 1,
                            precision: 0
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Permissions'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Grup'
                        }
                    }
                }
            }
        });
    </script>
@endsection
