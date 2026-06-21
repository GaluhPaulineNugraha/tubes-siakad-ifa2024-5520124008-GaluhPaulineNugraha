<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kartu Rencana Studi</title>
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
        .footer { margin-top: 30px; padding-top: 15px; border-top: 1px solid #ddd; font-size: 10px; color: #999; text-align: right; }
        .total-row { background-color: #f2f2f2; font-weight: bold; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h1>KARTU RENCANA STUDI (KRS)</h1>
        <p>Sistem Informasi Akademik - Universitas Nugraha</p>
        <p style="font-size: 11px; color: #888;">Periode: {{ date('F Y') }}</p>
    </div>

    <div class="info-section">
        <table class="info-table">
            <tr><td>NPM</td><td>: <strong>{{ $mahasiswa->npm }}</strong></td></tr>
            <tr><td>Nama Mahasiswa</td><td>: <strong>{{ $mahasiswa->nama }}</strong></td></tr>
            <tr><td>Program Studi</td><td>: <strong>Teknik Informatika</strong></td></tr>
            <tr><td>Dosen Wali</td><td>: <strong>{{ $mahasiswa->dosen->nama ?? '-' }}</strong></td></tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Kode MK</th>
                <th width="55%">Mata Kuliah</th>
                <th width="10%">SKS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($krsList as $index => $krs)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $krs->matakuliah->kode_matakuliah }}</td>
                <td style="text-align: left;">{{ $krs->matakuliah->nama_matakuliah }}</td>
                <td>{{ $krs->matakuliah->sks }} SKS</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="3" class="text-right"><strong>Total SKS</strong></td>
                <td><strong>{{ $totalSks }} SKS</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <div>Dokumen resmi Kartu Rencana Studi - Universitas Nugraha</div>
        <div>Dicetak pada: {{ date('d/m/Y H:i:s') }}</div>
    </div>
</body>
</html>