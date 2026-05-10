@php
    // Fungsi untuk mengubah angka nominal menjadi teks (Terbilang)
    function penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = penyebut($nilai - 10). " Belas";
        } else if ($nilai < 100) {
            $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " Seratus" . penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " Seribu" . penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
        }     
        return $temp;
    }
    
    function terbilang($nilai) {
        if($nilai<0) {
            $hasil = "Minus ". trim(penyebut($nilai));
        } else {
            $hasil = trim(penyebut($nilai));
        }
        return $hasil . " Rupiah";
    }

    // LOGIKA PENENTUAN NAMA PELANGGAN (Dari Dropdown atau Manual)
    $namaPelanggan = $sale->customer_name;
    if (empty($namaPelanggan) && !empty($sale->customer_id)) {
        $pelangganDb = \App\Models\Customer::find($sale->customer_id);
        $namaPelanggan = $pelangganDb ? $pelangganDb->name : 'Pelanggan Umum';
    } elseif (empty($namaPelanggan)) {
        $namaPelanggan = 'Pelanggan Umum';
    }
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi - {{ $sale->invoice_no }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #e5e7eb;
            margin: 0;
            padding: 20px;
        }
        .kwitansi-wrapper {
            background-color: #fff;
            width: 210mm;
            min-height: 100mm;
            margin: 0 auto;
            padding: 30px 40px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            position: relative;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        .logo-text {
            color: #d32f2f;
            font-size: 24px;
            font-weight: 900;
            font-style: italic;
            margin: 0;
            letter-spacing: 1px;
        }
        .logo-sub {
            font-size: 12px;
            color: #555;
            font-weight: bold;
        }
        .invoice-info {
            text-align: right;
        }
        .title-kwitansi {
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 3px;
            margin: 0 0 5px 0;
        }
        .info-text {
            font-size: 14px;
            margin: 2px 0;
        }
        .row-data {
            display: flex;
            margin-bottom: 12px;
            font-size: 15px;
            align-items: flex-start;
        }
        .label {
            width: 180px;
            font-weight: bold;
        }
        .colon {
            width: 20px;
            font-weight: bold;
        }
        .value {
            flex: 1;
            border-bottom: 1px dotted #999;
            padding-bottom: 2px;
        }
        .value-box {
            flex: 1;
            background-color: #fce4ec;
            border: 1px solid #333;
            padding: 5px 10px;
            font-weight: bold;
            font-style: italic;
            text-transform: capitalize;
            box-sizing: border-box;
        }
        .car-details {
            margin-left: 200px;
            margin-top: 5px;
            margin-bottom: 15px;
        }
        .car-details table {
            width: 80%;
            border-collapse: collapse;
            font-size: 15px;
        }
        .car-details td {
            padding: 3px 0;
        }
        .car-details td:first-child {
            width: 120px;
        }
        .car-details td:nth-child(2) {
            width: 15px;
        }
        .car-details td:last-child {
            border-bottom: 1px dotted #999;
        }
        .footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 40px;
        }
        .amount-container {
            width: 50%;
        }
        .amount-box {
            background-color: #fce4ec;
            border: 2px solid #333;
            padding: 8px 15px;
            font-size: 22px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 10px;
        }
        .disclaimer {
            font-size: 11px;
            color: #555;
            line-height: 1.4;
        }
        .signature-area {
            text-align: center;
            width: 250px;
        }
        .signature-date {
            margin-bottom: 70px;
            font-size: 15px;
        }
        .signature-name {
            font-weight: bold;
            text-decoration: underline;
            font-size: 15px;
        }
        @media print {
            body { background-color: #fff; padding: 0; }
            .kwitansi-wrapper { box-shadow: none; width: 100%; padding: 0; }
            .value-box, .amount-box {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

    <div class="kwitansi-wrapper">
        
        <div class="header">
            <div>
                <h1 class="logo-text">CV. NUSANTARA MOTOR</h1>
                <p class="logo-sub">Jual Beli Mobil Bekas Berkualitas</p>
            </div>
            <div class="invoice-info">
                <h2 class="title-kwitansi">KWITANSI</h2>
                <p class="info-text"><strong>No.</strong> {{ $sale->invoice_no }}</p>
                <p class="info-text"><strong>Tgl Transaksi:</strong> {{ \Carbon\Carbon::parse($sale->sale_date)->format('d M Y') }}</p>
            </div>
        </div>

        <div class="row-data">
            <div class="label">Terima dari</div>
            <div class="colon">:</div>
            <div class="value uppercase" style="text-transform: uppercase; font-weight: bold;">
                {{ $namaPelanggan }}
            </div>
        </div>

        <div class="row-data">
            <div class="label">Jumlah uang</div>
            <div class="colon">:</div>
            <div class="value-box">
                {{ terbilang($sale->total_amount) }}
            </div>
        </div>

        <div class="row-data" style="margin-bottom: 0;">
            <div class="label">Untuk pembayaran</div>
            <div class="colon">:</div>
            <div class="value" style="border: none;">
                Pembelian 1 Unit Mobil Bekas
            </div>
        </div>

        <div class="car-details">
            <table>
                <tr>
                    <td>Merk / Tipe</td>
                    <td>:</td>
                    <td>{{ $sale->car->merk ?? '-' }} / {{ $sale->car->tipe ?? '-' }}</td>
                </tr>
                <tr>
                    <td>No. Polisi</td>
                    <td>:</td>
                    <td style="text-transform: uppercase;">{{ $sale->car->nopol ?? '-' }}</td>
                </tr>
                <tr>
                    <td>No. Rangka</td>
                    <td>:</td>
                    <td style="text-transform: uppercase;">{{ $sale->car->no_rangka ?? '-' }}</td>
                </tr>
                <tr>
                    <td>No. Mesin</td>
                    <td>:</td>
                    <td style="text-transform: uppercase;">{{ $sale->car->no_mesin ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Tahun Produksi</td>
                    <td>:</td>
                    <td>{{ $sale->car->tahun ?? '-' }}</td>
                </tr>
            </table>
        </div>

        <div class="row-data">
            <div class="label">Keterangan</div>
            <div class="colon">:</div>
            <div class="value">
                Pembayaran atas nama <strong>{{ $namaPelanggan }}</strong> ({{ $sale->payment_status }})
            </div>
        </div>

        <div class="footer">
            <div class="amount-container">
                <div class="amount-box">
                    Rp. {{ number_format($sale->total_amount, 2, ',', '.') }}
                </div>
                <div class="disclaimer">
                    Kwitansi ini dianggap sah apabila pembayaran dengan cek / bilyet giro telah diuangkan / clearing pada rekening CV. Nusantara Motor.
                </div>
            </div>

            <div class="signature-area">
                <div class="signature-date">
                    Palembang, {{ \Carbon\Carbon::parse($sale->sale_date)->format('d F Y') }}
                </div>
                <div class="signature-name">
                    ( {{ auth()->user()->name ?? 'Admin Showroom' }} )
                </div>
            </div>
        </div>

    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>