@extends('layouts.app') @section('content')

<div class="wrapper">
        @include('finance.navbar')
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <h4 class="page-title">Anggaran</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Form Edit Anggaran</div>
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
                                    <form action="{{ route('budgets.update', $budget->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="id_budget">Nomor Anggaran</label>
                                            <input type="text" name="id_budget" class="form-control" id="id_budget" value="{{ $budget->id_budget }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="detail">Uraian</label>
                                            <textarea name="detail" class="form-control" id="detail" rows="3" placeholder="Masukan Uraian">{{ $budget->detail }}</textarea>
                                        </div>
                                        <div class="form-group d-flex" style="gap: 15px;">
                                            <div style="flex: 1;">
                                                <label for="volume">Volume</label>
                                                <input type="number" name="volume" class="form-control" id="volume" value="{{ $budget->volume }}">
                                            </div>
                                            <div style="flex: 1;">
                                                <label for="unit">Satuan</label>
                                                <input type="text" name="unit" class="form-control" id="unit" value="{{ $budget->unit }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="amount">Harga Satuan</label>
                                            <input type="number" name="amount" class="form-control" id="amount" value="{{ $budget->amount }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="total">Nominal</label>
                                            <input type="text" name="total" class="form-control" id="total" value="{{ $budget->total }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Update Anggaran</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Ambil elemen input
            const volumeInput = document.getElementById('volume');
            const amountInput = document.getElementById('amount');
            const totalInput = document.getElementById('total');

            // Fungsi untuk menghitung total
            function calculateTotal() {
                const volume = parseFloat(volumeInput.value) || 0;
                const amount = parseFloat(amountInput.value) || 0;
                const total = volume * amount;

                // Masukkan hasil ke input total
                totalInput.value = new Intl.NumberFormat('id-ID').format(total);
            }

            // Jalankan fungsi setiap kali ada input di volume atau harga
            volumeInput.addEventListener('input', calculateTotal);
            amountInput.addEventListener('input', calculateTotal);
        });
    </script>
@endsection