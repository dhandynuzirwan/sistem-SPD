<!DOCTYPE html>
<html>
<head>
    <title>Kwitansi - {{ $letter->letter_number }}</title>
    <style>
        @page { margin: 1cm; }
        body { font-family: Arial, sans-serif; font-size: 11pt; color: #333; }
        .kwitansi-border { border: 2px solid #000; padding: 20px; position: relative; }
        .header { text-align: center; border-bottom: 2px solid #000; margin-bottom: 15px; padding-bottom: 10px; }
        .row { display: table; width: 100%; margin-bottom: 10px; }
        .label { display: table-cell; width: 180px; font-weight: bold; }
        .dots { display: table-cell; width: 10px; }
        .value { display: table-cell; border-bottom: 1px dotted #000; font-style: italic; }
        .nominal-box { background: #eee; border: 2px solid #000; padding: 10px; display: inline-block; font-weight: bold; font-size: 14pt; margin-top: 20px; }
        .footer { margin-top: 30px; width: 100%; }
        .sig { float: right; text-align: center; width: 200px; }
    </style>
</head>
<body>
    <div class="kwitansi-border">
        <div class="header">
            <h2 style="margin:0;">PT ARSA JAYA PRIMA</h2>
            <small>Gedung Arsa Training, Sleman, Yogyakarta</small>
        </div>

        <h3 style="text-align:center; text-decoration: underline;">KWITANSI PEMBAYARAN</h3>
        
        <div class="row">
            <div class="label">Sudah Terima Dari</div>
            <div class="dots">:</div>
            <div class="value">Bendahara PT Arsa Jaya Prima</div>
        </div>
        <div class="row">
            <div class="label">Banyaknya Uang</div>
            <div class="dots">:</div>
            <div class="value" style="background:#f9f9f9;">*** {{ $terbilang }} ***</div>
        </div>
        <div class="row">
            <div class="label">Untuk Pembayaran</div>
            <div class="dots">:</div>
            <div class="value">Biaya Perjalanan Dinas ke {{ $letter->institution }} ({{ $letter->letter_number }})</div>
        </div>

        <div class="nominal-box">
            Rp. {{ number_format($letter->budget->total, 0, ',', '.') }},-
        </div>

        <div class="footer">
            <div style="float:left; width: 200px; text-align:center;">
                <p>Penerima,</p>
                <div style="height:60px;"></div>
                <strong>{{ $letter->employee->full_name }}</strong>
            </div>
            <div class="sig">
                <p>Yogyakarta, {{ date('d F Y') }}</p>
                <p>Bendahara,</p>
                <div style="height:60px;"></div>
                <strong>{{ $letter->finance->full_name }}</strong>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
</body>
</html>