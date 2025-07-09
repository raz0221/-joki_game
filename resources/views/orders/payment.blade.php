@extends('layouts.app')

@section('title', 'Konfirmasi Pembayaran')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Konfirmasi Pembayaran</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h5 class="alert-heading">Instruksi Pembayaran</h5>
                        <p class="mb-0">Silakan transfer sejumlah <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong> ke salah satu rekening berikut:</p>
                        <ul class="mt-2">
                            <li>Bank BCA: 1234567890 (HAFTAP Joki)</li>
                            <li>Bank Mandiri: 0987654321 (HAFTAP Joki)</li>
                            <li>DANA: 081234567890 (HAFTAP Joki)</li>
                        </ul>
                        <p class="mb-0">Setelah transfer, unggah bukti pembayaran pada form di bawah ini.</p>
                    </div>

                    <div class="mb-4">
                        <h5>Detail Pesanan</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Kode Pesanan:</strong> {{ $order->order_code }}</p>
                                <p><strong>Game:</strong> {{ $order->game->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Total Pembayaran:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                <p><strong>Batas Waktu:</strong> {{ \Carbon\Carbon::now()->addHours(24)->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('orders.confirm-payment', $order) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="payment_proof" class="form-label">Unggah Bukti Pembayaran</label>
                            <input class="form-control" type="file" id="payment_proof" name="payment_proof" required>
                            <div class="form-text">Format: JPG, PNG (Maks. 2MB)</div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Konfirmasi Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection