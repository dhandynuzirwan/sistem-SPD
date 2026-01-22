@extends('layouts.app') @section('content')

<div class="wrapper">
    @include('layouts.navbar')
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Anggaran</h4>
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                                <div class="card-title">Buat Anggaran</div>
                                <p class="card-category">Daftar anggaran perjalanan dinas.</p>
                            </div>
                        <div class="card-body">
                            <a href="{{ route('budgets.create') }}">
                                <button class="btn btn-success mb-3">Buat Anggaran</button>
                            </a>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>id_budget</th>
                                            <th>Uraian</th>
                                            <th>Volume</th>
                                            <th>Satuan</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($budgets as $index => $budget)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $budget->id_budget }}</td>
                                            <td>{{ $budget->detail }}</td>
                                            <td>{{ $budget->volume }}</td>
                                            <td>{{ $budget->unit }}</td>
                                            <td>{{ $budget->formatted_amount }}</td>
                                            <td class="font-weight-bold">{{ $budget->formatted_total }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('budgets.edit', $budget->id) }}" class="btn btn-primary mb-1 mr-1">
                                                        <i class="la la-edit"></i>
                                                    </a>   
                                                    <form action="{{ route('budgets.destroy', $budget->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger mb-1" onclick="return confirm('Are you sure you want to delete this budget?')">
                                                            <i class="la la-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada data anggaran.</td>
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