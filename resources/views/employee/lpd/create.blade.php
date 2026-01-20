@extends('layouts.app') @section('content')
<div class="wrapper">
        @include('employee.navbar')
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
                                    <div class="form-group">
                                        <label for="id_spd">Nomor Surat Tugas</label>
                                        <select class="form-control" id="role">
													<option>1</option>
													<option>2</option>
													<option>3</option>
												</select>
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
                                    </div>
                                    <div class="card-action">
                                        <button class="btn btn-success">Submit</button>
                                        <button class="btn btn-danger">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection