@extends('layouts.app') @section('content')
<div class="wrapper">
        @include('layouts.navbar')
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <h4 class="page-title">Laporan Perjalanan Dinas</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Form Edit Laporan Perjalanan Dinas</div>
                                </div>
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('reports.update', $report->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="report_id">Nomer Laporan</label>
                                            <input type="text" class="form-control" id="report_id" name="report_id" value="{{ $report->report_id }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="employee_id">Nama Pegawai</label>
                                            <select name="employee_id" class="form-control" id="employee_id" required>
                                                <option value="">-- Pilih Pegawai --</option>
                                                @foreach($employees as $employee)
                                                    <option value="{{ $employee->id }}" {{ $report->employee_id == $employee->id ? 'selected' : '' }}>
                                                        {{ $employee->full_name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="letter_number">Nomor Surat Tugas</label>
                                            <select name="letter_number" class="form-control" id="letter_number" required>
                                                <option value="">-- Pilih Surat Tugas --</option>
                                                @foreach($letters as $letter)
                                                    <option value="{{ $letter->id }}" {{ $report->letter_number == $letter->id ? 'selected' : '' }}>
                                                        {{ $letter->letter_number }} </option>
                                                @endforeach
                                            </select>                            
                                        </div>
                                        <div class="form-group">
                                            <label for="destination">Tujuan</label>
                                            <input type="text" class="form-control" id="destination" name="destination" value="{{ $report->destination }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Tanggal</label>
                                            <input type="date" class="form-control" id="date" name="date" value="{{ $report->date }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="subject">Perihal</label>
                                            <input type="text" class="form-control" id="subject" name="subject" value="{{ $report->subject }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Preview Laporan Saat Ini</label>
                                            <div class="mb-3">
                                                @if($report->report_file)
                                                    @php $extension = pathinfo($report->report_file, PATHINFO_EXTENSION); @endphp
                                                    
                                                    @if($extension == 'pdf')
                                                        <iframe src="{{ asset('storage/' . $report->report_file) }}" width="100%" height="400px"></iframe>
                                                    @else
                                                        <img src="{{ asset('storage/' . $report->report_file) }}" class="img-fluid img-thumbnail" style="max-height: 300px;">
                                                    @endif
                                                @else
                                                    <p class="text-danger">Belum ada file yang diunggah.</p>
                                                @endif
                                            </div>
                                            
                                            <label for="report_file">Ganti File Laporan (Opsional)</label>
                                            <input type="file" name="report_file" class="form-control-file" id="report_file">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Update Laporan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection