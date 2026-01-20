@extends('layouts.app') @section('content')

<div class="wrapper">
        @include('finance.navbar')
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
                                <a href="{{ route('letters.create') }}">
                                    <button class="btn btn-success mb-3">Buat Surat</button>
                                </a>
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
                                                    <button class="btn btn-default mb-1"><i class="la la-print"></i></button>
                                                    <button class="btn btn-primary mb-1"><i class="la la-edit"></i></button>
                                                    <form action="{{ route('letters.destroy', $letter->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger mb-1" onclick="return confirm('Are you sure you want to delete this letter?')">
                                                            <i class="la la-trash"></i>
                                                        </button>
                                                    </form>
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