@extends('layouts.app') @section('content')
    <div class="wrapper">
        @include('employee.navbar')
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
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td><span class="badge badge-count">Menunggu</span></td>
                                                <td>
                                                    <button class="btn btn-default mb-1"><i class="la la-print"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td><span class="badge badge-success">Disetujui</span></td>
                                                <td>
                                                    <button class="btn btn-default mb-1"><i class="la la-print"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td>Table cell</td>
                                                <td><span class="badge badge-success">Disetujui</span></td>
                                                <td>
                                                    <button class="btn btn-default mb-1"><i class="la la-print"></i></button>
                                                </td>
                                            </tr>
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