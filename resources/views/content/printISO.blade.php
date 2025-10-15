<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Permohonan Pengadaan/Perbaikan</title>
    <style>
    @page {
        size: A4;
        margin: 0.5cm;
    }
    body {
        font-family: "Arial", Times, serif;
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

    .tab {
        display: inline-block;
        margin-left: 40px;
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

    .doc-info-cell {
        width: 35%;
        padding: 0 !important;
    }

    .doc-info-table {
        width: 100%;
        border-collapse: collapse;
        height: 100%;
    }
        .doc-info-table td {
        text-align: left;
        border: 1px solid #000;
        padding: 4px 8px;
        font-size: 10pt;
    }

    </style>
</head>

<body>
    <div class="page-container">
        <table class="header-table">
            <tr style="height: 30%;">
                <td style="width:20%">
                    <img src="http://template-laravel12-main.test/public/assets/images/logo/icon.png" alt=""
                        class="h-6 mx-auto">
                </td>
                <td style="width:50%;">
                    <h2 class="title">FORM PERMOHONAN<br>PENGADAAN/PERBAIKAN</h2>
                </td>
                <td class="doc-info-cell" style="width:30%;">
                    <table class="doc-info-table" border="1">
                        <tr>
                            <td>No. Dok.&emsp;: FM-GA-005</td>
                        </tr>
                        <tr>
                            <td>Revisi&emsp;&nbsp;&emsp;: 00</td>
                        </tr>
                        <tr>
                            <td>Tgl. Efektif&nbsp;: 12-07-2024</td>
                        </tr>
                        <tr>
                            <td>Halaman&emsp;: 1 dari 1</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table class="info-table">
            <tr id="h1">
                <td id="h1" style="width:25%;">Divisi / Bagian&emsp; &emsp; &emsp;:</td>
                <td id="h1" style="width:35%; ">
                    {{ $permohonan->pemohon->department->dept_name ?? '..................' }}</>
                </td>
                <td id="h1" style="width:15%;">Tanggal&emsp;:</td>
                <td id="h1">
                    {{ $permohonan->created_at ? \Carbon\Carbon::parse($permohonan->created_at)->format('d/m/Y') : '............' }}
                    </>
                </td>
            </tr>
            <tr id="h1">
                <td id="h1">Status Permohonan&emsp;:</td>
                <td id="h1" colspan="2">
                    <input disabled type="checkbox"
                        {{ $permohonan->kepentingan == 'Sangat Mendesak' ? 'checked' : '' }}> Sangat
                    Mendesak
                    <input disabled type="checkbox" {{ $permohonan->kepentingan == 'Mendesak' ? 'checked' : '' }}>
                    Mendesak
                    <input disabled type="checkbox" {{ $permohonan->kepentingan == 'Normal' ? 'checked' : '' }}> Normal

                </td>
                <td id="h1">
                    <div id="no_permohonn">No. Permohonan : {{ $permohonan->no_permohonan}}</div>
                </td>
            </tr>
        </table>
        <table class="main-table">
            <thead>
                <tr>
                    <th id="main-table" style="width:5%;">No.</th>
                    <th id="main-table" style="width:55%;">Item Permohonan<br>
                        <div style="font-weight: 400;">(jika ada gambar/foto mohon dilampirkan)</div>
                    </th>
                    <th id="main-table" style="width:40%;">Alasan Permohonan</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="main-table">1</td>
                    <td id="main-table">
                        <div class="flex flex-col gap-1">
                            @foreach ($permohonan->barang as $barang)
                            <div>{{ $barang->nama_barang }} ({{ $barang->pivot->jumlah }})</div>
                            @endforeach
                        </div>
                    </td>
                    <td id="main-table">
                        <div>{!! $permohonan->alasan_permohonan ?? '-' !!} 
                            <br> <strong>Lokasi :</strong> {!!$permohonan->lokasi->nama_lokasi ?? '-' !!}
                    </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div>
            <p></p>
        </div>
        <table class="est-act-table">
            <tbody>
                <tr>
                    <td style="height:50px;width:60%;"><strong>Estimasi biaya yang dikeluarkan</strong>
                        <br>(diisi oleh bagian General Affair untuk proses persetujuan lampirkan juga penawaran dari
                        kontraktor atau supplier)
                    </td>
                    <td style="text-align: left;width:40%;vertical-align:middle;">Rp {{ $permohonan->est_biaya  }}</td>
                </tr>
                <tr>
                    <td style="height: 50px;width:60%;"> <strong>Aktual biaya yang dikeluarkan</strong>
                        <br>(diisi oleh bagian General Affair, lampirkan hasil pengadaan / perbaikan dari kontraktor
                        dan supplier serta foto hasil pengadaan / perbaikan yang telah selesai)
                    </td>
                    <td style="text-align: left;width:40%;vertical-align:middle;">Rp {{ $permohonan->akt_biaya  }}</td>
                </tr>
            </tbody>
        </table>
        <div style="font-size:x-small;">*) :Coret salah satu &#9744; : contreng "✓" salah satu</div>
        <table class="signature">
            <tr>
                <td id="signature">Klaten,<br>Dibuat
                    Oleh,<br><br><br><br><br><u>{{ $permohonan->pemohon->fullname?? '____________' }}</u><br>Pemohon
                    ({{$permohonan->pemohon->department->dept_code}})</td>
                <td id="signature">Ditinjau
                    Oleh,<br><br><br><br><br><br><u>{{ $permohonan->peninjau->fullname ?? '____________' }}</u><br>Peninjau(GA)
                </td>
                <td id="signature">Disetujui
                    Oleh,<br><br><br><br><br><br><u>{{ $permohonan->approver->username ?? '____________' }}</u><br>Manager
                    GA
                </td>
            </tr>
        </table>
    </div>

    <script>
    window.print();
    </script>
</body>

</html>