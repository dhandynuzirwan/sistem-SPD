<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SPD - {{ $letter->letter_number }}</title>
    <style>
        /* Pengaturan Kertas dan Font Utama */
        @page { margin: 1.2cm; }
        body { 
            font-family: 'Times New Roman', Times, serif; 
            font-size: 11pt; 
            line-height: 1.5; 
            color: #000; 
            margin: 0;
            padding: 0;
        }

        /* Kop Surat */
        .kop-table { width: 100%; border-bottom: 3px double #000; margin-bottom: 20px; padding-bottom: 10px; }
        .logo { width: 80px; text-align: center; vertical-align: middle; }
        .perusahaan-info { text-align: center; vertical-align: middle; }
        .perusahaan-name { font-size: 16pt; font-weight: bold; margin: 0; text-transform: uppercase; }
        .perusahaan-detail { font-size: 9pt; margin: 0; font-weight: normal; }

        /* Judul Dokumen */
        .title-box { text-align: center; margin-bottom: 20px; }
        .title { font-size: 13pt; font-weight: bold; text-decoration: underline; margin-bottom: 2px; }
        .subtitle { font-size: 11pt; font-weight: normal; }

        /* Tabel Detail SPD */
        .content-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .content-table td { 
            padding: 6px 8px; 
            vertical-align: top; 
            border: 1px solid #000; 
        }

        /* Bagian Anggaran */
        .budget-header { 
            font-weight: bold; 
            margin-top: 15px; 
            margin-bottom: 8px; 
            font-size: 11pt; 
            text-transform: uppercase;
        }
        .budget-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .budget-table th { 
            background-color: #f2f2f2; 
            border: 1px solid #000; 
            padding: 8px; 
            font-size: 10pt; 
            text-align: center; 
        }
        .budget-table td { 
            border: 1px solid #000; 
            padding: 8px; 
            font-size: 10pt; 
        }

        /* Footer & Tanda Tangan */
        .footer-section { width: 100%; margin-top: 20px; }
        /* Opsional: Saya kecilkan sedikit wrapper-nya agar lebih proporsional dengan gambar yang mengecil */
        .signature-wrapper { float: right; width: 200px; text-align: center; } /* Sebelumnya 220px */
        /* BAGIAN YANG DIUBAH: */
        .signature-image { 
            width: 100px; /* Diubah dari 130px menjadi 100px */
            height: auto; 
            margin: 5px 0; 
        }
        .signature-wrapper p {
            margin: 0; /* Menghapus jarak antar paragraf */
            padding: 0;
            line-height: 1.2; /* Mengatur kerapatan baris teks */
        }

        .signature-box {
            margin: 5px 0; /* Memberi sedikit ruang hanya untuk area tanda tangan */
        }

        .signature-wrapper .font-bold {
            margin-top: 5px; /* Memberi jarak sedikit di atas nama pimpinan */
            display: inline-block;
        }

        /* Utility */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
    </style>
</head>
<body>

    <table class="kop-table">
        <tr>
            <td class="logo">
                <img src="{{ public_path('assets/img/logo-arsa.png') }}" alt="Logo" style="width: 70px;">
            </td>
            <td class="perusahaan-info">
                <h1 class="perusahaan-name">PT ARSA JAYA PRIMA</h1>
                <p class="perusahaan-detail">
                    Gedung Arsa Training, Jl. Kaliurang KM 10, Sleman, Yogyakarta<br>
                    Telp: (0274) 123456 | Email: info@arsajayaprima.com | Website: www.arsajayaprima.com
                </p>
            </td>
        </tr>
    </table>

    <div class="title-box">
        <div class="title">SURAT PERJALANAN DINAS (SPD)</div>
        <div class="subtitle">Nomor: {{ $letter->letter_number }}</div>
    </div>

    <table class="content-table">
        <tr>
            <td width="5%" class="text-center">1.</td>
            <td width="35%">Pejabat Pemberi Perintah</td>
            <td>{{ $letter->finance->full_name }}</td>
        </tr>
        <tr>
            <td class="text-center">2.</td>
            <td>Nama Pegawai yang diperintah</td>
            <td class="font-bold">{{ $letter->employee->full_name }}</td>
        </tr>
        <tr>
            <td class="text-center">3.</td>
            <td>Tingkat Biaya Perjalanan Dinas</td>
            <td>{{ $letter->cost_level }}</td>
        </tr>
        <tr>
            <td class="text-center">4.</td>
            <td>Maksud Perjalanan Dinas</td>
            <td>{{ $letter->subject }}</td>
        </tr>
        <tr>
            <td class="text-center">5.</td>
            <td>Alat Angkut yang dipergunakan</td>
            <td>{{ $letter->transportation }}</td>
        </tr>
        <tr>
            <td class="text-center">6.</td>
            <td>Tempat Berangkat<br>Tempat Tujuan</td>
            <td>Kantor Pusat Yogyakarta<br>{{ $letter->institution }}</td>
        </tr>
        <tr>
            <td class="text-center">7.</td>
            <td>Lamanya Perjalanan Dinas</td>
            <td>{{ \Carbon\Carbon::parse($letter->departure_date)->diffInDays($letter->return_date) }} (Hari)</td>
        </tr>
        <tr>
            <td class="text-center">8.</td>
            <td>Tanggal Berangkat<br>Tanggal Kembali</td>
            <td>{{ \Carbon\Carbon::parse($letter->departure_date)->format('d F Y') }}<br>{{ \Carbon\Carbon::parse($letter->return_date)->format('d F Y') }}</td>
        </tr>
        <tr>
            <td class="text-center">9.</td>
            <td>Pengikut: Nama</td>
            <td>{{ $letter->follower ?: '-' }}</td>
        </tr>        
        <tr>
            <td class="text-center">10.</td>
            <td>Keterangan Lain-lain</td>
            <td>{{ $letter->description ?: '-' }}</td>
        </tr>
    </table>

    <div class="budget-header">Rincian Pembebanan Anggaran</div>
    <table class="budget-table">
        <thead>
            <tr>
                <th width="15%">Kode</th>
                <th width="35%">Detail Keperluan</th>
                <th width="15%">Volume</th>
                <th width="15%">Satuan</th>
                <th width="20%">Total</th>
            </tr>
        </thead>
        <tbody>
            @if($letter->budget)
            <tr>
                <td class="text-center">{{ $letter->budget->id_budget }}</td>
                <td>{{ $letter->budget->detail }}</td>
                <td class="text-center">{{ $letter->budget->volume }}</td>
                <td class="text-center">{{ $letter->budget->unit }}</td>
                <td class="text-right font-bold">Rp {{ number_format($letter->budget->total, 0, ',', '.') }}</td>
            </tr>
            @else
            <tr>
                <td colspan="5" class="text-center">Data anggaran tidak ditemukan.</td>
            </tr>
            @endif
        </tbody>
    </table>

    <div class="footer-section">
        <div class="signature-wrapper">
            <p>Dikeluarkan di: Yogyakarta</p>
            <p>Tanggal: {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
            <p style="margin-top: 5px;">Pimpinan PT Arsa Jaya Prima,</p>
            
            <div class="signature-box">
                @if($letter->status == 'approved')
                    <img src="{{ public_path('assets/img/ttd-pimpinan.png') }}" class="signature-image">
                @else
                    <div class="signature-space"></div>
                    <p style="color: red; font-style: italic; font-size: 8pt;">(Belum Disetujui / Draft)</p>
                @endif
            </div>

            <p>
                <span class="font-bold" style="text-decoration: underline;">{{ $letter->director->full_name }}</span><br>
                <span style="font-size: 10pt;">Direktur Utama</span>
            </p>
        </div>
    </div>

</body>
</html>