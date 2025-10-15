<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Permohonan Pengadaan/Perbaikan</title>
    <style>
    @page {
        size: A4;
        margin: 1.5cm;
    }

    body {
        font-family: "Times New Roman", Times, serif;
        font-size: 12pt;
        margin: 40px;
    }

    .header,
    .footer {
        width: 100%;
        border-collapse: collapse;
    }

    .header td,
    .footer td {
        vertical-align: top;
    }

    .title {
        text-align: center;
        font-weight: bold;
        font-size: 14pt;
        text-decoration: underline;
    }

    .info-table {
        width: 100%;
        margin-top: 10px;
        border-collapse: collapse;
    }

    .info-table td {
        padding: 3px 5px;
        vertical-align: top;
    }

    .main-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        border: 1px solid black;
    }

    .main-table th,
    .main-table td {
        border: 1px solid black;
        padding: 6px;
        text-align: left;
    }

    .sub-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        border: 1px solid black;
    }

    .sub-table td,
    .sub-table th {
        border: 1px solid black;
        padding: 6px;
    }

    .signature {
        width: 100%;
        text-align: center;
        margin-top: 40px;
    }

    .signature td {
        padding-top: 50px;
    }

    @media print {
        body {
            margin: 20mm;
        }
    }

    .lampiran {
        margin-top: 30px;
    }

    .lampiran h4 {
        margin-bottom: 10px;
        text-decoration: underline;
        text-align: left;
    }

    .foto-container {
        display: flex;
        justify-content: space-around;
        margin-top: 10px;
    }

    .foto {
        text-align: center;
        width: 45%;
    }

    .foto img {
        width: 100%;
        height: auto;
        border: 1px solid #000;
        margin-top: 5px;
    }

    .page-container {
        width: 100%;
        max-width: 19cm;
        margin: 0 auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 4px;
        text-align: center;
        vertical-align: top;
    }

    #signature {
        border: 0px solid #000;
        padding: 4px;
        text-align: left;
        vertical-align: top;
    }

    #h1 {
        border: 0px solid #000;
        padding: 4px;
        text-align: left;
        vertical-align: top;
    }

    #main-table {
        border: 1px solid #000;
        padding: 4px;
        text-align: center;
        vertical-align: top;
    }

    .foto img {
        max-width: 8cm;
        max-height: 6cm;
        object-fit: cover;
        border: 1px solid #000;
    }
    </style>
</head>

<body>
    <div class="page-container">
        <table class="header">
            <tr>
                <td style="width:20%">
                    <img src="http://template-laravel12-main.test/public/assets/images/logo/icon.png" alt=""
                        class="h-6 mx-auto">
                </td>
                <td style="width:50%;">
                    <h2 class="title">FORM PERMOHONAN<br>PENGADAAN/PERBAIKAN</h2>
                </td>
                <td style="width:30%;">
                    <table class="info-table" border="1">
                        <tr>
                            <td>No. Dok. : {{$permohonan->no_permohonan}}</td>
                        </tr>
                        <tr>
                            <td>Revisi : 00</td>
                        </tr>
                        <tr>
                            <td>Tgl Efektif : 12-07-2024</td>
                        </tr>
                        <tr>
                            <td>Halaman : 1 dari 1</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table class="info-table">
            <tr id="h1">
                <td id="h1" style="width:25%;">Divisi/Bagian:</td>
                <td id="h1" style="width:35%; ">
                    <strong>{{ $permohonan->pemohon->department->dept_name ?? '..................' }}</strong>
                </td>
                <td id="h1" style="width:15%;">Tanggal:</td>
                <td id="h1">
                    <strong>{{ $permohonan->created_at ? \Carbon\Carbon::parse($permohonan->created_at)->format('d/m/Y') : '............' }}</strong>
                </td>
            </tr>
            <tr id="h1">
                <td id="h1">Status Permohonan:</td>
                <td id="h1" colspan="3">
                    <input disabled type="checkbox"
                        {{ $permohonan->kepentingan == 'Sangat Mendesak' ? 'checked' : '' }}> Sangat
                    Mendesak
                    <input disabled type="checkbox" {{ $permohonan->kepentingan == 'Mendesak' ? 'checked' : '' }}>
                    Mendesak
                    <input disabled type="checkbox" {{ $permohonan->kepentingan == 'Normal' ? 'checked' : '' }}> Normal
                </td>
            </tr>
            <tr id="h1">
                <td id="h1">Jenis Permohonan:</td>
                <td id="h1" colspan="3">
                    <input disabled type="checkbox"
                        {{ $permohonan->jenis_permohonan->nama_jenis_permohonan == 'Perbaikan Barang' ? 'checked' : '' }}>
                    Perbaikan Barang
                    <input disabled type="checkbox"
                        {{ $permohonan->jenis_permohonan->nama_jenis_permohonan == 'Penggantian Barang' ? 'checked' : '' }}>
                    Penggantian Barang
                    <input disabled type="checkbox"
                        {{ $permohonan->jenis_permohonan->nama_jenis_permohonan == 'Pengadaan Barang Baru' ? 'checked' : '' }}>
                    Pengadaan Barang Baru
                </td>
            </tr>
        </table>

        <table class="main-table">
            <thead>
                <tr>
                    <th id="main-table" style="width:5%;">No</th>
                    <th id="main-table" style="width:20%;">Item Permohonan</th>
                    <th id="main-table" style="width:40%;">Alasan Permohonan</th>
                    <th id="main-table" style="width:15%;">Lokasi</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="main-table">1</td>
                    <td id="main-table">
                        <div class="flex flex-col gap-1">
                            @foreach ($permohonan->barang as $barang)
                            <div>{{ $barang->nama_barang }}</div>
                            @endforeach
                        </div>
                    </td>
                    <td id="main-table">
                        <div>{!! $permohonan->alasan_permohonan ?? '-' !!}</div>
                    </td>
                    <td id="main-table">{{$permohonan->lokasi->nama_lokasi}}</td>
                </tr>
            </tbody>
        </table>
        <div>
            <p></p>
        </div>
        <table class="est-act-table">
            <thead>
                <tr>
                    <th style="width:50%;">Keterangan</th>
                    <th style="width:50%;">Biaya</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="height:50px;">Estimasi Biaya yang Dikeluarkan : Rp {{ $permohonan->est_biaya  }}</td>
                    <td> Aktual Biaya yang Dikeluarkan : Rp {{ $permohonan->akt_biaya  }}</td>
                </tr>
            </tbody>
        </table>

        <table class="signature">
            <tr>
                <td id="signature">Klaten,<br>Dibuat
                    Oleh,<br><br><br><br><br><u>{{ $permohonan->pemohon->username ?? '____________' }}</u><br>Pemohon
                    ({{$permohonan->pemohon->department->dept_name}})</td>
                <td id="signature">Ditinjau
                    Oleh,<br><br><br><br><br><u>{{ $permohonan->peninjau->username ?? '____________' }}</u><br>GA</td>
                <td id="signature">Disetujui
                    Oleh,<br><br><br><br><br><u>{{ $permohonan->approver->username ?? '____________' }}</u><br>Manager
                </td>
            </tr>
        </table>
        <div class="lampiran">
            <h4>Lampiran Foto</h4>
            <div class="foto-container">
                <div class="foto">
                    <p><strong>Before:</strong></p>
                    <img src="{{ asset('storage/app/public/'.$permohonan->foto_sebelum) }}" alt="Foto Before">
                </div>
                <div class="foto">
                    <p><strong>After:</strong></p>
                    <img src="{{ asset('storage/app/public/'.$permohonan->foto_sesudah) }}" alt="Foto After">
                </div>
            </div>
        </div>
    </div>

    <script>
    window.print();
    </script>
</body>

</html>