<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan KRS - Semua Mahasiswa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background: white;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #0A2540;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            color: #0A2540;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0;
            color: #666;
            font-size: 12px;
        }
        .info-section {
            margin-bottom: 20px;
            background: #f8f9fa;
            padding: 12px;
            border-radius: 8px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 5px;
            font-size: 12px;
        }
        .info-table td:first-child {
            width: 120px;
            font-weight: bold;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .data-table th {
            background-color: #0A2540;
            color: white;
            padding: 10px 8px;
            font-size: 11px;
            text-align: center;
        }
        .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 10px;
        }
        .data-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            border-top: 1px solid #ddd;
            padding-top: 20px;
            font-size: 10px;
            color: #666;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN KRS</h1>
        <p>Sistem Informasi Akademik - Universitas Nugraha</p>
        <p>Periode: {{ date('F Y') }}</p>
    </div>
    
    <div class="info-section">
        <table class="info-table">
            <tr><td>Tanggal Cetak</td><td>: {{ date('d/m/Y H:i:s') }}</td></tr>
            <tr><td>Total Data</td><td>: {{ $krsList->count() }} Pengambilan KRS</td></tr>
        </table>
    </div>
    
    <table class="data-table">
        <thead>
            <tr>
                <th width="30">No</th>
                <th width="100">NPM</th>
                <th width="150">Nama Mahasiswa</th>
                <th width="100">Kode MK</th>
                <th width="200">Mata Kuliah</th>
                <th width="40">SKS</th>
                <th width="80">Tanggal Ambil</th>
            </tr>
        </thead>
        <tbody>
            @foreach($krsList as $index => $krs)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ $krs->mahasiswa->npm ?? '-' }}</td>
                <td>{{ $krs->mahasiswa->nama ?? '-' }}</td>
                <td class="text-center">{{ $krs->matakuliah->kode_matakuliah ?? '-' }}</td>
                <td>{{ $krs->matakuliah->nama_matakuliah ?? '-' }}</td>
                <td class="text-center">{{ $krs->matakuliah->sks ?? '-' }}</td>
                <td class="text-center">{{ $krs->created_at ? $krs->created_at->format('d/m/Y') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
        <p>Dokumen ini adalah laporan resmi dari Sistem Informasi Akademik</p>
    </div>
</body>
</html>