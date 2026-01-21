@extends('layouts.app') @section('content')
    <div class="wrapper">
        @include('layouts.navbar')
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <h4 class="page-title">Surat Perjalanan Dinas</h4>
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Data Surat Perjalanan Dinas</div>
                            </div>
                            <div class="card-body mb-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nomer Surat Tugas</th>
                                                <th>Finance</th>
                                                <th>Pegawai</th>
                                                <th>Pimpinan</th>
                                                <th>Nomer Anggaran</th>
                                                <th>Tingkat Biaya Anggaran</th>
                                                <th>Perihal</th>
                                                <th>Kendaraan</th>
                                                <th>Tanggal Berangkat</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Pengikut</th>
                                                <th>Keterangan</th>
                                                <th>Perusahaan</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($letters as $index => $letter)
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>{{ $letter->letter_number }}</td>
                                                <td>{{ $letter->finance->full_name }}</td>
                                                <td>{{ $letter->employee->full_name }}</td>
                                                <td>{{ $letter->director->full_name }}</td>
                                                <td>{{ $letter->budget->id_budget }}</td>
                                                <td>{{ $letter->cost_level }}</td>
                                                <td>{{ $letter->subject }}</td>
                                                <td>{{ $letter->transportation }}</td>
                                                <td>{{ $letter->departure_date }}</td>
                                                <td>{{ $letter->return_date }}</td>
                                                <td>{{ $letter->follower }}</td>
                                                <td>{{ $letter->description }}</td>
                                                <td>{{ $letter->institution }}</td>
                                                <td>
                                                    @if($letter->status == 'pending')
                                                        <span class="badge badge-warning">Pending</span>
                                                    @elseif($letter->status == 'approved')
                                                        <span class="badge badge-success">Disetujui</span>
                                                    @else
                                                        <span class="badge badge-danger">Ditolak</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($letter->status == 'approved')
                                                        <a href="{{ route('letters.print', $letter->id) }}" class="btn btn-info mb-1" target="_blank">
                                                            <i class="la la-print"></i>
                                                        </a>
                                                    @else
                                                        <button class="btn btn-secondary mb-1" disabled><i class="la la-print"></i></button>
                                                    @endif
                                                </td>   
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="16" class="text-center">Tidak ada data surat perjalanan dinas.</td>
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