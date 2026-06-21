@extends('layouts.app')

@section('content')
<div class="container-fluid px-2 px-md-4">
    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <h4 class="mb-1 fw-semibold">Dashboard Admin</h4>
            <p class="text-muted small mb-0">Selamat datang, <strong>Administrator</strong></p>
        </div>
        <div class="text-start text-md-end">
            <small class="text-muted">{{ now()->format('l, d F Y') }}</small>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-2 g-md-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted text-uppercase" style="font-size: 10px;">Total Dosen</small>
                            <h2 class="mb-0 fw-bold mt-1" style="font-size: 1.5rem;">{{ number_format($totalDosen ?? 0) }}</h2>
                        </div>
                        <div class="rounded-3 p-2 p-md-3" style="background: #e8f0fe;">
                            <i class="fas fa-chalkboard-user fa-1x fa-md-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted text-uppercase" style="font-size: 10px;">Total Mahasiswa</small>
                            <h2 class="mb-0 fw-bold mt-1" style="font-size: 1.5rem;">{{ number_format($totalMahasiswa ?? 0) }}</h2>
                        </div>
                        <div class="rounded-3 p-2 p-md-3" style="background: #e6f4ea;">
                            <i class="fas fa-users fa-1x fa-md-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted text-uppercase" style="font-size: 10px;">Mata Kuliah</small>
                            <h2 class="mb-0 fw-bold mt-1" style="font-size: 1.5rem;">{{ number_format($totalMatakuliah ?? 0) }}</h2>
                        </div>
                        <div class="rounded-3 p-2 p-md-3" style="background: #fef3e6;">
                            <i class="fas fa-book fa-1x fa-md-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted text-uppercase" style="font-size: 10px;">Pengambilan KRS</small>
                            <h2 class="mb-0 fw-bold mt-1" style="font-size: 1.5rem;">{{ number_format($totalKRS ?? 0) }}</h2>
                        </div>
                        <div class="rounded-3 p-2 p-md-3" style="background: #e6f7ff;">
                            <i class="fas fa-clipboard-list fa-1x fa-md-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- GRAFIK STATISTIK -->
    <div class="row g-3 g-md-4 mb-4">
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-3 pt-md-4 pb-0 px-3 px-md-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-semibold mb-0">
                                <i class="fas fa-calendar-alt me-2 text-primary"></i>Jadwal Kelas per Hari
                            </h6>
                            <small class="text-muted">Distribusi jadwal perkuliahan berdasarkan hari</small>
                        </div>
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1">
                            <i class="fas fa-rotate me-1" onclick="refreshChart('jadwalChart')" style="cursor: pointer;"></i>
                            {{ \App\Models\Jadwal::count() }} Total
                        </span>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4">
                    <div style="position: relative; height: 280px;">
                        <canvas id="jadwalChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-3 pt-md-4 pb-0 px-3 px-md-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-semibold mb-0">
                                <i class="fas fa-users me-2 text-success"></i>Mahasiswa per Dosen Wali
                            </h6>
                            <small class="text-muted">Jumlah mahasiswa bimbingan per dosen</small>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">
                            <i class="fas fa-rotate me-1" onclick="refreshChart('mahasiswaChart')" style="cursor: pointer;"></i>
                            {{ \App\Models\Mahasiswa::count() }} Total
                        </span>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4">
                    <div style="position: relative; height: 280px;">
                        <canvas id="mahasiswaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Terbaru -->
    <div class="row g-3 g-md-4">
        <div class="col-12 col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 pt-3 pt-md-4 pb-0 px-3 px-md-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h6 class="fw-semibold mb-0">
                        <i class="fas fa-chalkboard-user me-2 text-primary"></i>Dosen Terbaru
                    </h6>
                    <a href="{{ route('dosen.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">Lihat Semua</a>
                </div>
                <div class="card-body p-3 p-md-4">
                    @forelse($latestDosen ?? [] as $dosen)
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 pb-2 border-bottom">
                        <div>
                            <div class="fw-semibold">{{ $dosen->nama }}</div>
                            <small class="text-muted">{{ $dosen->nidn }}</small>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">Aktif</span>
                    </div>
                    @empty
                    <div class="text-center py-3 text-muted">Belum ada data</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 pt-3 pt-md-4 pb-0 px-3 px-md-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h6 class="fw-semibold mb-0">
                        <i class="fas fa-users me-2 text-success"></i>Mahasiswa Terbaru
                    </h6>
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-sm btn-outline-success rounded-pill">Lihat Semua</a>
                </div>
                <div class="card-body p-3 p-md-4">
                    @forelse($latestMahasiswa ?? [] as $mhs)
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 pb-2 border-bottom">
                        <div>
                            <div class="fw-semibold">{{ $mhs->nama }}</div>
                            <small class="text-muted">{{ $mhs->npm }} • {{ $mhs->dosen->nama ?? '-' }}</small>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">Aktif</span>
                    </div>
                    @empty
                    <div class="text-center py-3 text-muted">Belum ada data</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // ==========================================
    // 1. GRAFIK JADWAL PER HARI
    // ==========================================
    const ctxJadwal = document.getElementById('jadwalChart').getContext('2d');
    
    // Data dari server (dikirim dari controller)
    const hariLabels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
    const jadwalData = @json($jadwalPerHari ?? []);
    
    // Warna gradasi untuk grafik
    const colors = [
        '#4F46E5', // Indigo
        '#7C3AED', // Violet
        '#2563EB', // Blue
        '#0891B2', // Cyan
        '#059669', // Emerald
        '#D97706'  // Amber
    ];
    
    // Warna background dengan opacity
    const backgroundColors = colors.map(c => c + '40');
    
    const jadwalChart = new Chart(ctxJadwal, {
        type: 'bar',
        data: {
            labels: hariLabels,
            datasets: [{
                label: 'Jumlah Jadwal',
                data: jadwalData,
                backgroundColor: backgroundColors,
                borderColor: colors,
                borderWidth: 2,
                borderRadius: 8,
                barPercentage: 0.7,
                categoryPercentage: 0.8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(255,255,255,0.95)',
                    titleColor: '#1a2a3a',
                    bodyColor: '#4a5568',
                    borderColor: '#e2e8f0',
                    borderWidth: 1,
                    cornerRadius: 12,
                    padding: 12,
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + ' Jadwal';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: {
                            size: 11
                        }
                    },
                    grid: {
                        color: 'rgba(0,0,0,0.05)',
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 11,
                            weight: '600'
                        }
                    }
                }
            }
        }
    });

    // ==========================================
    // 2. GRAFIK MAHASISWA PER DOSEN WALI
    // ==========================================
    const ctxMahasiswa = document.getElementById('mahasiswaChart').getContext('2d');
    
    const dosenLabels = @json($dosenWaliLabels ?? []);
    const mahasiswaData = @json($mahasiswaPerDosen ?? []);
    
    // Warna gradasi untuk batang horizontal
    const colors2 = [
        '#4F46E5', '#7C3AED', '#2563EB', '#0891B2', 
        '#059669', '#D97706', '#DC2626', '#7C3AED'
    ];
    
    const mahasiswaChart = new Chart(ctxMahasiswa, {
        type: 'bar',
        data: {
            labels: dosenLabels,
            datasets: [{
                label: 'Jumlah Mahasiswa Bimbingan',
                data: mahasiswaData,
                backgroundColor: colors2.slice(0, mahasiswaData.length).map(c => c + '40'),
                borderColor: colors2.slice(0, mahasiswaData.length),
                borderWidth: 2,
                borderRadius: 8,
                barPercentage: 0.7,
                categoryPercentage: 0.8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(255,255,255,0.95)',
                    titleColor: '#1a2a3a',
                    bodyColor: '#4a5568',
                    borderColor: '#e2e8f0',
                    borderWidth: 1,
                    cornerRadius: 12,
                    padding: 12,
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + ' Mahasiswa';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: {
                            size: 11
                        }
                    },
                    grid: {
                        color: 'rgba(0,0,0,0.05)',
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 10,
                            weight: '500'
                        },
                        maxRotation: 45,
                        minRotation: 30
                    }
                }
            }
        }
    });

    // ==========================================
    // 3. FUNGSI REFRESH CHART
    // ==========================================
    function refreshChart(chartId) {
        if (chartId === 'jadwalChart') {
            // Refresh data dari server (AJAX)
            fetch('{{ route("dashboard.chart.jadwal") }}')
                .then(response => response.json())
                .then(data => {
                    jadwalChart.data.datasets[0].data = data;
                    jadwalChart.update();
                })
                .catch(() => {
                    // Jika gagal, reload page
                    window.location.reload();
                });
        } else if (chartId === 'mahasiswaChart') {
            fetch('{{ route("dashboard.chart.mahasiswa") }}')
                .then(response => response.json())
                .then(data => {
                    mahasiswaChart.data.datasets[0].data = data;
                    mahasiswaChart.update();
                })
                .catch(() => {
                    window.location.reload();
                });
        }
    }
</script>
@endpush

<style>
@media print {
    .btn, .btn-sm, .btn-outline-secondary, .btn-danger, .btn-primary, .btn-success, .btn-warning {
        display: none !important;
    }
    .sidebar {
        display: none !important;
    }
    .main-content {
        margin-left: 0 !important;
        padding: 20px !important;
    }
    .card {
        border: 1px solid #ddd !important;
        box-shadow: none !important;
    }
    .navbar-top {
        display: none !important;
    }
    .btn-close {
        display: none !important;
    }
    .card-header {
        background: #f8f9fa !important;
    }
    body {
        background: white !important;
    }
}
</style>
@endsection