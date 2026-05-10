<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; color: #000; }
        .container { max-width: 800px; margin: 0 auto; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #000; padding: 8px; text-align: left; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        @media print {
            @page { margin: 1cm; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="container">
        <div class="header">
            <h2>LAPORAN PENJUALAN</h2>
            <h3>MULIA JAYA COMPUTER</h3>
            <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Tanggal</th>
                    <th>Unit Terjual (Nopol)</th>
                    <th>Pelanggan</th>
                    <th class="text-right">Harga Jual</th>
                    <th class="text-right">PPN Dipungut (1,1%)</th>
                    <th class="text-right">Laba Bersih (ROI)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $index => $sale)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('d/m/Y') }}</td>
                        <td>{{ $sale->car->merk ?? 'N/A' }} ({{ $sale->car->nopol ?? '-' }})</td>
                        <td>{{ $sale->customer_name }}</td>
                        <td class="text-right">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($sale->tax_amount, 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($sale->roi_amount, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-right">TOTAL KESELURUHAN :</th>
                    <th class="text-right">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</th>
                    <th class="text-right">Rp {{ number_format($totalTax, 0, ',', '.') }}</th>
                    <th class="text-right">Rp {{ number_format($totalROI, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
        
        <div style="margin-top: 50px; text-align: right;">
            <p>Palembang, {{ now()->format('d M Y') }}</p>
            <br><br><br>
            <p><strong>( ____________________ )</strong></p>
            <p>Pimpinan / Admin</p>
        </div>
    </div>

</body>
</html>