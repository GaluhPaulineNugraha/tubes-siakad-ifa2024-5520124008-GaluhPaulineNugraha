<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Jadwal Kuliah</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px 30px;
            background: white;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 3px solid #0A2540;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            color: #0A2540;
            font-size: 22px;
            letter-spacing: 2px;
        }
        .header p {
            margin: 5px 0 0;
            color: #555;
            font-size: 12px;
        }
        .info-section {
            margin-bottom: 20px;
            background: #f8f9fa;
            padding: 12px 18px;
            border-radius: 6px;
            border-left: 4px solid #0A2540;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 4px 8px;
            font-size: 12px;
        }
        .info-table td:first-child {
            width: 120px;
            font-weight: bold;
            color: #333;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .data-table th {
            background-color: #0A2540;
            color: white;
            padding: 10px 12px;
            font-size: 11px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .data-table td {
            border: 1px solid #ddd;
            padding: 10px 12px;
            font-size: 11px;
            text-align: center;
        }
        .data-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .data-table tr:hover {
            background-color: #f1f5f9;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            border-top: 1px solid #ddd;
            padding-top: 15px;
            font-size: 10px;
            color: #999;
        }
        .badge {
            background: #e8f0fe;
            color: #0A2540;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <h1>JADWAL KULIAH</h1>
        <p>Sistem Informasi Akademik - Universitas Nugraha</p>
        <p style="font-size: 11px; color: #888;">Periode: {{ date('F Y') }}</p>
    </div>

    <!-- INFO MAHASISWA -->
    <div class="info-section">
        <table class="info-table">
            <tr>
                <td>NPM</td>
                <td>: <strong>{{ $mahasiswa->npm }}</strong></td>
                <td style="width: 40px;"></td>
                <td>Program Studi</td>
                <td>: <strong>Teknik Informatika</strong></td>
            </tr>
            <tr>
                <td>Nama Mahasiswa</td>
                <td>: <strong>{{ $mahasiswa->nama }}</strong></td>
                <td></td>
                <td>Semester</td>
                <td>: <strong>Genap 2024/2025</strong></td>
            </tr>
            <tr>
                <td>Dosen Wali</td>
                <td>: <strong>{{ $mahasiswa->dosen->nama ?? '-' }}</strong></td>
                <td></td>
                <td>Jumlah MK</td>
                <td>: <strong>{{ $jadwal->count() }} Mata Kuliah</strong></td>
            </tr>
        </table>
    </div>

    <!-- TABEL JADWAL -->
    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="12%">Kode MK</th>
                <th width="25%">Mata Kuliah</th>
                <th width="5%">SKS</th>
                <th width="10%">Hari</th>
                <th width="10%">Jam</th>
                <th width="8%">Kelas</th>
                <th width="25%">Dosen</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jadwal as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $item->matakuliah->kode_matakuliah ?? '-' }}</strong></td>
                <td style="text-align: left;">{{ $item->matakuliah->nama_matakuliah ?? '-' }}</td>
                <td>{{ $item->matakuliah->sks ?? '-' }}</td>
                <td><span class="badge">{{ $item->hari }}</span></td>
                <td>{{ date('H:i', strtotime($item->jam)) }}</td>
                <td>{{ $item->kelas }}</td>
                <td style="text-align: left;">{{ $item->dosen->nama ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; padding: 30px; color: #999;">
                    Belum ada jadwal kuliah
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        <span>📄 Dokumen resmi Jadwal Kuliah - Universitas Nugraha</span>
        <br>
        <span>Dicetak pada: {{ date('d/m/Y H:i:s') }}</span>
    </div>

</body>
</html>