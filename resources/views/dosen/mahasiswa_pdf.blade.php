<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mahasiswa Bimbingan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; margin: 20px 30px; background: white; }
        .header { text-align: center; margin-bottom: 25px; border-bottom: 3px solid #0A2540; padding-bottom: 15px; }
        .header h1 { color: #0A2540; font-size: 22px; letter-spacing: 2px; }
        .header p { color: #555; font-size: 12px; }
        .info-section { margin-bottom: 20px; background: #f8f9fa; padding: 12px 18px; border-radius: 6px; border-left: 4px solid #0A2540; }
        .info-table { width: 100%; border-collapse: collapse; }
        .info-table td { padding: 4px 8px; font-size: 12px; }
        .info-table td:first-child { width: 120px; font-weight: bold; }
        .data-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .data-table th { background-color: #0A2540; color: white; padding: 10px 12px; font-size: 11px; text-align: center; text-transform: uppercase; letter-spacing: 0.5px; }
        .data-table td { border: 1px solid #ddd; padding: 10px 12px; font-size: 11px; text-align: center; }
        .data-table tr:nth-child(even) { background-color: #f9f9f9; }
        .footer { margin-top: 30px; text-align: center; border-top: 1px solid #ddd; padding-top: 15px; font-size: 10px; color: #999; }
        .badge-success { background: #d1fae5; color: #065f46; padding: 2px 10px; border-radius: 12px; font-size: 10px; font-weight: 600; }
    </style>
</head>
<body>
    <div class="header">
        <h1>MAHASISWA BIMBINGAN</h1>
        <p>Dosen: {{ $dosen->nama }}</p>
        <p style="font-size: 11px; color: #888;">Periode: {{ date('F Y') }}</p>
    </div>

    <div class="info-section">
        <table class="info-table">
            <tr><td>NIDN</td><td>: <strong>{{ $dosen->nidn }}</strong></td></tr>
            <tr><td>Nama Dosen</td><td>: <strong>{{ $dosen->nama }}</strong></td></tr>
            <tr><td>Total Mahasiswa</td><td>: <strong>{{ $mahasiswa->count() }}</strong></td></tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">NPM</th>
                <th width="35%">Nama Mahasiswa</th>
                <th width="25%">Jumlah MK Diambil</th>
                <th width="15%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mahasiswa as $index => $mhs)
            @php $jumlahMK = App\Models\KRS::where('npm', $mhs->npm)->count(); @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $mhs->npm }}</strong></td>
                <td style="text-align: left;">{{ $mhs->nama }}</td>
                <td>{{ $jumlahMK }} Mata Kuliah</td>
                <td><span class="badge-success">Aktif</span></td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;padding:30px;color:#999;">Belum ada mahasiswa bimbingan</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <span>📄 Dokumen resmi Mahasiswa Bimbingan - Universitas Nugraha</span><br>
        <span>Dicetak pada: {{ date('d/m/Y H:i:s') }}</span>
    </div>
</body>
</html>