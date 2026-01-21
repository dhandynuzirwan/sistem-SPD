@extends('layouts.app') @section('content')

<div class="wrapper">
        @include('layouts.navbar')
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($reports as $report)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $report->employee->full_name }}</td>
                                                    <td>{{ $report->letter->letter_number }}</td>
                                                    <td>{{ $report->destination }}</td>
                                                    <td>{{ $report->date }}</td>
                                                    <td>{{ $report->subject }}</td>
                                                    <td>
                                                        @if($report->report_file)
                                                            @php
                                                                // Mendapatkan ekstensi file untuk menentukan jenis preview
                                                                $extension = pathinfo($report->report_file, PATHINFO_EXTENSION);
                                                                $filePath = asset('storage/' . $report->report_file);
                                                            @endphp

                                                            <div class="d-flex align-items-center">
                                                                @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png']))
                                                                    <a href="{{ $filePath }}" target="_blank" class="mr-2">
                                                                        <img src="{{ $filePath }}" 
                                                                            alt="LPD Preview" 
                                                                            style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px; border: 1px solid #ebedf2;">
                                                                    </a>
                                                                @elseif(strtolower($extension) == 'pdf')
                                                                    <a href="{{ $filePath }}" target="_blank" class="btn btn-link btn-danger p-0 mr-2" title="Lihat PDF">
                                                                        <i class="la la-file-pdf-o" style="font-size: 32px;"></i>
                                                                    </a>
                                                                @else
                                                                    <a href="{{ $filePath }}" target="_blank" class="btn btn-link btn-info p-0 mr-2">
                                                                        <i class="la la-file-text" style="font-size: 32px;"></i>
                                                                    </a>
                                                                @endif
                                                                <a href="{{ $filePath}}" class="" target="_blank">
                                                                    <span>{{ basename($report->report_file) }}</span>
                                                                </a>
                                                                
                                                            </div>
                                                        @else
                                                            <span class="badge badge-count">Tidak ada file</span>
                                                        @endif
                                                    </td>
                                                    
                                                </tr>
                                            @endforeach
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
