@extends('layouts.home')
@section('title', 'Data Permissions')

@section('css')
    <link rel="stylesheet" href="{{ asset('flatpickr/flatpickr.min.css') }}">
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center mb-4">
                <div class="col-md-5 text-center">
                    @php
                        $defaultStart = \Carbon\Carbon::now()->subDays(6)->format('d-m-Y');
                        $defaultEnd = \Carbon\Carbon::now()->format('d-m-Y');
                    @endphp
                    <form id="filterForm">
                        <label for="rangeTanggal" class="form-label">📅 Pilih Rentang Tanggal</label>
                        <input type="text" id="rangeTanggal" name="rangeTanggal"
                            value="{{ $defaultStart . ' to ' . $defaultEnd }}" class="form-control text-center mb-2"
                            placeholder="Tanggal Mulai - Tanggal Akhir" readonly>

                        <button type="submit" class="btn btn-primary">
                            🔍 Tampilkan
                        </button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h6 class="text-center">📈 Harga Jual Harian</h6>
                    <canvas id="myChartHarianTanaman" style="width:100%; max-height:300px;"></canvas>
                </div>
                <div class="col-md-6 mb-4">
                    <h6 class="text-center">📉 Panen Harian</h6>
                    <canvas id="myChartHarianPanen" style="width:100%; max-height:300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="{{ asset('flatpickr/flatpickr.min.js') }}"></script>
    <script>
        flatpickr("#rangeTanggal", {
            mode: "range",
            dateFormat: "d-m-Y", // Sesuaikan jika pakai Y-m-d
            defaultDate: [
                "{{ $defaultStart }}",
                "{{ $defaultEnd }}"
            ]
        });
    </script>

    {{-- <script>
        const labels = {!! json_encode($labels) !!};
        const datasets = {!! json_encode($datasets) !!};

        new Chart("myChart", {
            type: "line",
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Harga Jual Harian Tanaman'
                    }
                },
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        title: {
                            display: true,
                            text: 'Harga Jual'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal'
                        }
                    }
                }
            }
        });
    </script> --}}
    <script>
        let chartHarianTanaman = null;

        document.getElementById('filterForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const range = document.getElementById('rangeTanggal').value;

            if (!range) {
                alert('Silakan pilih rentang tanggal terlebih dahulu.');
                return;
            }

            fetch(`/laporan-harian-tanaman?rangeTanggal=${encodeURIComponent(range)}`)
                .then(res => res.json())
                .then(data => {
                    const ctx = document.getElementById('myChartHarianTanaman').getContext('2d');

                    if (chartHarianTanaman) chartHarianTanaman.destroy();

                    chartHarianTanaman = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.labels,
                            datasets: data.datasets
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top'
                                },
                                title: {
                                    display: true,
                                    text: '📈 Grafik Harga Jual Harian'
                                }
                            },
                            interaction: {
                                mode: 'index',
                                intersect: false
                            },
                            scales: {
                                y: {
                                    beginAtZero: false,
                                    title: {
                                        display: true,
                                        text: 'Harga (Rp)'
                                    },
                                    ticks: {
                                        callback: value => 'Rp ' + value.toLocaleString()
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Tanggal'
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(err => {
                    console.error('Gagal memuat data:', err);
                    alert('Terjadi kesalahan saat memuat data.');
                });
        });
    </script>
    <script>
        let chartHarianPanen = null;

        document.getElementById('filterForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const range = document.getElementById('rangeTanggal').value;

            if (!range) {
                alert('Silakan pilih rentang tanggal terlebih dahulu.');
                return;
            }

            fetch(`/laporan-harian-panen?rangeTanggal=${encodeURIComponent(range)}`)
                .then(res => res.json())
                .then(data => {
                    const ctx = document.getElementById('myChartHarianPanen').getContext('2d');

                    // Destroy chart lama jika sudah ada
                    if (chartHarianPanen) chartHarianPanen.destroy();

                    const warnaList = [
                        '#3cb44b', '#f58231'
                    ];

                    // Tambahkan warna ke tiap dataset
                    const coloredDatasets = data.datasets.map((ds, index) => ({
                        ...ds,
                        borderColor: warnaList[index % warnaList.length],
                        backgroundColor: 'transparent'
                    }));

                    // Buat chart baru
                    chartHarianPanen = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.labels,
                            datasets: coloredDatasets
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top'
                                },
                                title: {
                                    display: true,
                                    text: '📊 Grafik Jumlah Panen Harian'
                                }
                            },
                            interaction: {
                                mode: 'index',
                                intersect: false
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Jumlah Panen (kg)'
                                    },
                                    ticks: {
                                        stepSize: 1,
                                        precision: 0
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Tanggal'
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(err => {
                    console.error('Gagal memuat data:', err);
                    alert('Terjadi kesalahan saat memuat data.');
                });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Trigger form submit pertama kali saat page load
            document.getElementById('filterForm').dispatchEvent(new Event('submit'));
        });
    </script>
@endsection
