<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kartu Rencana Studi</title>
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
            margin-bottom: 25px;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 8px;
            font-size: 12px;
        }
        .info-table td:first-child {
            width: 130px;
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
            padding: 10px;
            font-size: 12px;
            text-align: center;
        }
        .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 11px;
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
        .total-row {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>KARTU RENCANA STUDI (KRS)</h1>
        <p>Sistem Informasi Akademik - Universitas Nugraha</p>
        <p>Periode: {{ date('F Y') }}</p>
    </div>
    
    <div class="info-section">
        <table class="info-table">
            <tr><td>NPM</td><td>: <strong>{{ $mahasiswa->npm }}</strong></td></tr>
            <tr><td>Nama Mahasiswa</td><td>: <strong>{{ $mahasiswa->nama }}</strong></td></tr>
            <tr><td>Program Studi</td><td>: Teknik Informatika</td></tr>
            <tr><td>Dosen Wali</td><td>: {{ $mahasiswa->dosen->nama ?? '-' }}</td></tr>
        </table>
    </div>
    
    <table class="data-table">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="20%" class="text-center">Kode MK</th>
                <th width="55%">Mata Kuliah</th>
                <th width="10%" class="text-center">SKS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($krsList as $index => $krs)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ $krs->matakuliah->kode_matakuliah }}</td>
                <td>{{ $krs->matakuliah->nama_matakuliah }}</td>
                <td class="text-center">{{ $krs->matakuliah->sks }} SKS</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="3" class="text-right"><strong>Total SKS</strong></td>
                <td class="text-center"><strong>{{ $totalSks }} SKS</strong></td>
            </tr>
        </tbody>
    </table>
    
    <div class="footer">
        <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
        <p>Dokumen ini adalah bukti resmi pengambilan mata kuliah</p>
    </div>
</body>
</html>