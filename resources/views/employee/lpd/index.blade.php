@extends('layouts.app') @section('content')

    <div class="wrapper">
        @include('employee.navbar')
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <h4 class="page-title">Laporan Perjalanan Dinas</h4>
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Data Laporan</div>
                            </div>
                            <div class="card-body">
                                <a href="lpd_create.html">
                                    <button class="btn btn-success mb-3">Buat Laporan</button>
                                </a>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Pegawai</th>
                                                <th>Nomer Surat Tugas</th>
                                                <th>Kota/Kab Tujuan</th>
                                                <th>Tanggal Pelaksanaan</th>
                                                <th>Maksud Perjalanan</th>
                                                <th>File</th>
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
                                                <td>
                                                    <button class="btn btn-default mb-1"><i class="la la-print"></i></button>
                                                    <button class="btn btn-primary mb-1"><i class="la la-edit"></i></button>
                                                    <button class="btn btn-danger mb-1"><i class="la la-trash"></i></button>
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
                                                <td>
                                                    <button class="btn btn-default mb-1"><i class="la la-print"></i></button>
                                                    <button class="btn btn-primary mb-1"><i class="la la-edit"></i></button>
                                                    <button class="btn btn-danger mb-1"><i class="la la-trash"></i></button>
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
                                                <td>
                                                    <button class="btn btn-default mb-1"><i class="la la-print"></i></button>
                                                    <button class="btn btn-primary mb-1"><i class="la la-edit"></i></button>
                                                    <button class="btn btn-danger mb-1"><i class="la la-trash"></i></button>
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