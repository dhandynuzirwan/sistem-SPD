@extends('layouts.app') 

@section('content')
    <div class="wrapper">
        @include('finance.navbar')
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <h4 class="page-title">Pegawai</h4>
                    <div class="row">
                        <div class="col-md-8"> 
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Form Edit Data Pegawai</div>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                                    @csrf
                                    @method('PUT') <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="username">Username</label>
                                                <input type="text" name="username" class="form-control" id="username" 
                                                       value="{{ old('username', $employee->username) }}" required>
                                                <small class="form-text text-muted">Username harus unik.</small>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" class="form-control" id="password" 
                                                       placeholder="Kosongkan jika tidak ingin mengubah password">
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label for="full_name">Nama Lengkap</label>
                                                <input type="text" name="full_name" class="form-control" id="full_name" 
                                                       value="{{ old('full_name', $employee->full_name) }}" required>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="nik">NIK</label>
                                                <input type="text" name="nik" class="form-control" id="nik" 
                                                       value="{{ old('nik', $employee->nik) }}" required>
                                            </div>

                                            <div class="col-md-12 form-check">
                                                <label>Jenis Kelamin</label><br/>
                                                <label class="form-radio-label">
                                                    <input class="form-radio-input" type="radio" name="gender" value="male" 
                                                           {{ old('gender', $employee->gender) == 'male' ? 'checked' : '' }}>
                                                    <span class="form-radio-sign">Pria</span>
                                                </label>
                                                <label class="form-radio-label ml-3">
                                                    <input class="form-radio-input" type="radio" name="gender" value="female"
                                                           {{ old('gender', $employee->gender) == 'female' ? 'checked' : '' }}>
                                                    <span class="form-radio-sign">Wanita</span>
                                                </label>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label for="place_of_birth">Tempat Kelahiran</label>
                                                <input type="text" name="place_of_birth" class="form-control" id="place_of_birth" 
                                                       value="{{ old('place_of_birth', $employee->place_of_birth) }}" required>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="date_of_birth">Tanggal Lahir</label>
                                                <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" 
                                                       value="{{ old('date_of_birth', $employee->date_of_birth) }}" required>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label for="blood_type">Golongan Darah</label>
                                                <input type="text" name="blood_type" class="form-control" id="blood_type" 
                                                       value="{{ old('blood_type', $employee->blood_type) }}">
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label for="position">Jabatan</label>
                                                <input type="text" name="position" class="form-control" id="position" 
                                                       value="{{ old('position', $employee->position) }}" required>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="role">Hak Akses</label>
                                                <select class="form-control" name="role" id="role" required>
                                                    <option value="finance" {{ old('role', $employee->role) == 'finance' ? 'selected' : '' }}>Finance</option>
                                                    <option value="director" {{ old('role', $employee->role) == 'director' ? 'selected' : '' }}>Pimpinan</option>
                                                    <option value="employee" {{ old('role', $employee->role) == 'employee' ? 'selected' : '' }}>Pegawai</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-action">
                                        <button type="submit" class="btn btn-success">Update Data</button>
                                        <a href="{{ route('employees.index') }}" class="btn btn-danger">Cancel</a>
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