@extends('layouts.app') @section('content')

<div class="wrapper">
    @include('layouts.navbar')
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Pegawai</h4>
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Data pegawai</div>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('employees.create') }}" class="btn btn-success mb-3">
                                Tambah Pegawai
                            </a>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIK</th>
                                            <th>Nama Lengkap</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tempat Kelahiran</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Golongan Darah</th>
                                            <th>Jabatan</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Hak Akses</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($employees as $index => $employee)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $employee->nik }}</td>
                                            <td>{{ $employee->full_name }}</td>
                                            <td>{{ $employee->gender == 'male' ? 'Pria' : 'Wanita' }}</td>
                                            <td>{{ $employee->place_of_birth }}</td>
                                            <td>{{ $employee->date_of_birth }}</td>
                                            <td>{{ $employee->blood_type ?? '-' }}</td>
                                            <td>{{ $employee->position }}</td>
                                            <td>{{ $employee->username }}</td>
                                            <td>{{ $employee->password }}</td>
                                            <td>
                                                <span class="badge badge-warning">{{ ucfirst($employee->role) }}</span>
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary mb-1 mr-1">
                                                        <i class="la la-edit"></i>
                                                    </a>

                                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger mb-1" onclick="return confirm('Yakin ingin menghapus?')">
                                                            <i class="la la-trash"></i>
                                                        </button> 
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10" class="text-center">Data pegawai masih kosong.</td>
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