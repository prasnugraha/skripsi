<!DOCTYPE html>
<html>
<head>
    <title>Sebaran Nilai Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-5">
        @foreach($data as $namaMahasiswa => $nilai)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">{{ $namaMahasiswa }}</h5>
                </div>
                <div class="card-body">
                    <canvas id="chart-{{ $loop->index }}"></canvas>
                    <script>
                        var ctx = document.getElementById('chart-{{ $loop->index }}').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: @json(array_keys($nilai)),
                                datasets: [{
                                    label: 'Jumlah Mahasiswa',
                                    data: @json(array_map('count', $nilai)),
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>
