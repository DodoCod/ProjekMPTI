@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard Tes Kesehatan Mental</h1>
    <p class="text-gray-600">Halaman ini menunjukkan jumlah pernyataan, responden, dan grafik rata-rata kondisi responden.</p>
</div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        {{-- Total Soal Card --}}
        <a href="{{ route('admin.questions.index') }}" class="group">
            <div class="bg-white p-6 rounded-xl shadow-md 
                border border-gray-200
                transition-all duration-200 transform
                hover:-translate-y-1 hover:shadow-lg hover:border-indigo-300">
                
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0 w-14 h-14 bg-cyan-50 rounded-xl flex items-center justify-center 
                        group-hover:bg-cyan-100 transition-colors duration-200">
                        <svg class="w-7 h-7 text-cyan-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                        </svg>
                    </div>

                    <div class="flex-1">
                        <p class="text-4xl font-bold text-gray-900 mb-1">
                            {{ App\Models\Question::count() }}
                        </p>
                        <p class="text-sm font-medium text-gray-600">Soal</p>
                    </div>
                </div>

            </div>
        </a>

        {{-- Total Responden Card --}}
        <a href="{{ route('admin.responses.index') }}" class="group">
            <div class="bg-white p-6 rounded-xl shadow-md 
                border border-gray-200
                transition-all duration-200 transform
                hover:-translate-y-1 hover:shadow-lg hover:border-indigo-300">

                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0 w-14 h-14 bg-purple-50 rounded-xl flex items-center justify-center 
                        group-hover:bg-purple-100 transition-colors duration-200">
                        <svg class="w-7 h-7 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                    </div>

                    <div class="flex-1">
                        <p class="text-4xl font-bold text-gray-900 mb-1">
                            {{ App\Models\Participant::count() }}
                        </p>
                        <p class="text-sm font-medium text-gray-600">Responden</p>
                    </div>
                </div>

            </div>
        </a>

    </div>


{{-- Chart Section --}}
<div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-900 mb-1">Grafik Rata-Rata Kondisi Responden</h2>
        <p class="text-sm text-gray-600">Visualisasi rata-rata skor dari semua responden berdasarkan kategori</p>
    </div>
    
    <div class="relative" style="height: 400px;">
        <canvas id="averageScoreChart"></canvas>
    </div>
</div>

{{-- Chart.js Script --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data dari backend
    const averageDepression = {{ $averageDepression ?? 0 }};
    const averageAnxiety = {{ $averageAnxiety ?? 0 }};
    const averageStress = {{ $averageStress ?? 0 }};

    // Cari nilai maksimum dari data untuk menentukan scale
    const maxValue = Math.max(averageDepression, averageAnxiety, averageStress);
    // Tambahkan buffer 20% di atas nilai maksimum agar bar tidak mentok
    const yAxisMax = Math.ceil(maxValue * 1.2);

    const ctx = document.getElementById('averageScoreChart').getContext('2d');
    
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Depression', 'Anxiety', 'Stress'],
            datasets: [{
                label: 'Rata-Rata Hasil Responden',
                data: [averageDepression, averageAnxiety, averageStress],
                backgroundColor: [
                    'rgba(16, 185, 129, 0.15)',
                    'rgba(34, 197, 94, 0.15)',
                    'rgba(59, 130, 246, 0.15)'
                ],
                borderColor: [
                    'rgb(16, 185, 129)',
                    'rgb(34, 197, 94)',
                    'rgb(59, 130, 246)'
                ],
                borderWidth: 1.5,
                borderRadius: 6,
                barThickness: 100
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        font: {
                            size: 13,
                            weight: '600',
                            family: "'Plus Jakarta Sans', sans-serif"
                        },
                        color: '#374151',
                        padding: 15,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(17, 24, 39, 0.95)',
                    padding: 12,
                    titleFont: {
                        size: 13,
                        weight: '600',
                        family: "'Plus Jakarta Sans', sans-serif"
                    },
                    bodyFont: {
                        size: 13,
                        family: "'Plus Jakarta Sans', sans-serif"
                    },
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    borderWidth: 1,
                    displayColors: true,
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.parsed.y.toFixed(2);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: yAxisMax,
                    ticks: {
                        font: {
                            size: 11,
                            family: "'Plus Jakarta Sans', sans-serif"
                        },
                        color: '#6b7280'
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.04)',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 13,
                            weight: '500',
                            family: "'Plus Jakarta Sans', sans-serif"
                        },
                        color: '#374151'
                    },
                    grid: {
                        display: false,
                        drawBorder: false
                    }
                }
            }
        }
    });
});
</script>
@endsection