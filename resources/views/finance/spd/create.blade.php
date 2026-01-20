@extends('layouts.app') @section('content')

<div class="wrapper">
        @include('finance.navbar')
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <h4 class="page-title">Surat Perjalanan Dinas</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Form Surat Perjalanan Dinas</div>
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
                                    <form action="{{ route('letters.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="letter_number">Nomor Surat Tugas</label>
                                            <input type="text" name="letter_number" class="form-control" id="letter_number" placeholder="Masukan Nomor Surat Tugas" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="finance_id">Finance</label>                                            
                                            <select name="finance_id" class="form-control" id="finance_id" required>
                                                <option value="">Pilih Finance</option>
                                                @foreach($finances as $finance)
                                                    <option value="{{ $finance->id }}">{{ $finance->full_name }}</option>
                                                @endforeach
                                            </select>                                      
                                        </div>
                                        <div class="form-group">
                                            <label for="director_id">Pimpinan</label>
                                            <select name="director_id" class="form-control" id="director_id" required>
                                                <option value="">Pilih Pimpinan</option>
                                                @foreach($directors as $director)
                                                    <option value="{{ $director->id }}">{{ $director->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="employee_id">Pegawai</label>
                                            <select name="employee_id" class="form-control" id="employee_id" required>
                                                <option value="">Pilih Pegawai</option>
                                                @foreach($employees as $employee)
                                                    <option value="{{ $employee->id }}">{{ $employee->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="budget_id">Nomer Anggaran</label>
                                            <select name="budget_id" class="form-control" id="budget_id" required>
                                                <option value="">Pilih Anggaran</option>
                                                @foreach($budgets as $budget)
                                                    <option value="{{ $budget->id }}">{{ $budget->id_budget }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="cost_level">Tingkat Biaya Anggaran</label>
                                            <input type="text" name="cost_level" class="form-control" id="cost_level" placeholder="Masukan Tingkat Biaya Anggaran" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="subject">Perihal</label>
                                            <input type="text" name="subject" class="form-control" id="subject" placeholder="Masukan Perihal" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="transportation">Kendaraan</label>
                                            <input type="text" name="transportation" class="form-control" id="transportation" placeholder="Masukan Kendaraan" required>
                                        </div>
                                        <div class="d-flex" style="gap: 15px;">
                                            <div class="form-group" style="flex: 1;">
                                                <label for="departure_date">Tanggal Berangkat</label>
                                                <input type="date" name="departure_date" class="form-control" id="departure_date" required>
                                            </div>
                                            <div class="form-group" style="flex: 1;">
                                                <label for="return_date">Tanggal Selesai</label>
                                                <input type="date" name="return_date" class="form-control" id="return_date" required>
                                            </div>
                                        </div>
                                        <div class="d-flex" style="gap: 15px;">
                                            <div class="form-group" style="flex: 1;">
                                                <label for="follower">Pengikut</label>
                                                <input type="text" name="follower" class="form-control" id="follower" placeholder="Masukan Pengikut">
                                            </div>
                                            <div class="form-group" style="flex: 1;">
                                                <label for="description">Keterangan</label>
                                                <textarea name="description" class="form-control" id="description" rows="3" placeholder="Masukan Keterangan"></textarea>
                                            </div>                                            
                                        </div>  
                                        <div class="form-group">
                                            <label for="institution">Perusahaan</label>
                                            <input type="text" name="institution" class="form-control" id="institution" placeholder="Masukan Perusahaan" required>
                                        </div>                                      
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Simpan Surat</button>
                                        </div>
                                    </form>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection