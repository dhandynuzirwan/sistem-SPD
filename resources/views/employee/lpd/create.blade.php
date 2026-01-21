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
                                    <div class="card-title">Form Laporan Perjalanan Dinas</div>
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
                                    <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="report_id">Nomer Laporan</label>
                                            <input type="text" class="form-control" id="report_id" name="report_id" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="employee_id">Nama Pegawai</label>
                                            <select name="employee_id" class="form-control" id="employee_id" required>
                                                <option value="">Pilih Pegawai</option>
                                                @foreach($employees as $employee)
                                                    <option value="{{ $employee->id }}">{{ $employee->full_name }}</option>
                                                @endforeach
                                            </select> 
                                        </div>
                                        <div class="form-group">
                                            <label for="letter_number">Nomer Surat Tugas</label>
                                            <select name="letter_number" class="form-control" id="letter_number" required>
                                                <option value="">Pilih Surat Tugas</option>
                                                @foreach($letters as $letter)
                                                    <option value="{{ $letter->id }}">{{ $letter->letter_number }}</option>
                                                @endforeach
                                            </select>                            
                                        </div>
                                        <div class="form-group">
                                            <label for="destination">Kota/Kab Tujuan</label>
                                            <input type="text" name="destination" class="form-control" id="destination" placeholder="Masukan Kota/Kab Tujuan">
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Tanggal Pelaksanaan</label>
                                            <input type="date" name="date" class="form-control" id="date" placeholder="Masukan Tanggal Pelaksanaan">
                                        </div>
                                        <div class="form-group">
                                            <label for="subject">Maksud Perjalanan Dinas</label>
                                            <textarea class="form-control" name="subject" id="subject" rows="3" placeholder="Masukan Maksud Perjalanan Dinas"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="report_file">Uploud File Laporan</label>
                                            <input type="file" name="report_file" class="form-control-file" id="report_file">
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="no_surat">Nomer Surat Tugas</label>
                                            <input type="text" class="form-control" id="no_surat" placeholder="Masukan Nomer Surat Tugas">
                                        </div>
                                        <div class="form-group">
                                            <label for="id_director">Nama PIC</label>
                                            <select class="form-control" id="role">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="lokasi">Kota/Kab Tujuan</label>
                                            <input type="text" class="form-control" id="lokasi" placeholder="Masukan Kota/Kab Tujuan">
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Tanggal Pelaksanaan</label>
                                            <input type="text" class="form-control" id="date" placeholder="Masukan Tanggal Pelaksanaan">
                                        </div>
                                        <div class="form-group">
                                            <label for="maksud">Maksud Perjalanan Dinas</label>
                                            <textarea class="form-control" id="maksud" rows="3" placeholder="Masukan Maksud Perjalanan Dinas"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="file-laporan">Uploud File Laporan</label>
                                            <input type="file" class="form-control-file" id="file-laporan">
                                        </div> --}}
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Simpan Laporan</button>
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