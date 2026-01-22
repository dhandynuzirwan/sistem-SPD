@extends('layouts.app') 

@section('content')
    <div class="wrapper">
        @include('layouts.navbar')
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <h4 class="page-title">Kwitansi Pembayaran</h4>
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Daftar Anggaran & Kwitansi</div>
                                <p class="card-category">Cetak kwitansi berdasarkan anggaran perjalanan dinas yang disetujui.</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        {{-- table-head-bg-primary --}}
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Budget</th>
                                                <th>No. Surat</th>
                                                <th>Tujuan Perjalanan</th>
                                                <th>Total Biaya</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($budgets as $index => $budget)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td><span class="badge badge-count">{{ $budget->id_budget }}</span></td>
                                                {{-- Mengambil nomor surat lewat relasi letter --}}
                                                <td><strong>{{ $budget->letter->letter_number ?? 'Tidak Terkait' }}</strong></td>
                                                <td>{{ $budget->letter->institution ?? '-' }}</td>
                                                <td class="text-primary font-weight-bold">
                                                    Rp. {{ number_format($budget->total, 0, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{-- Link diarahkan ke route budget.print yang kita buat di BudgetController --}}
                                                    <a href="{{ route('budget.print', $budget->id) }}" 
                                                       target="_blank" 
                                                       class="btn btn-info btn-sm">
                                                        <i class="la la-print"></i> Cetak Kwitansi
                                                    </a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Belum ada data anggaran yang tersedia.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection