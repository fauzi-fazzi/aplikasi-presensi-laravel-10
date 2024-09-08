<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kegiatan</title>
    <style>
        @media print {
            @page {
                size: landscape;
                margin: 0;
            }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border: 1px solid #000;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Laporan Kegiatan Bulan {{ $namabulan[$bulan] }} Tahun {{ $tahun }}</h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    @for ($i = 1; $i <= 31; $i++)
                        <th>{{ $i }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach ($rekap as $data)
                    <tr>
                        <td>{{ $data->nim }}</td>
                        <td>{{ $data->nama_lengkap }}</td>
                        @for ($i = 1; $i <= 31; $i++)
                            <td>{{ $data->{'tgl_' . $i} ?? '-' }}</td>
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="footer">
            <p>Dicetak pada: {{ date('d M Y H:i:s') }}</p>
        </div>
    </div>
</body>

</html>
