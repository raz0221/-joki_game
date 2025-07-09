@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Detail Pesanan - {{ $order->order_code }}</h4>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Informasi Pesanan</h5>
                    <p><strong>Game:</strong> {{ $order->game->name }}</p>
                    <p><strong>Tanggal Pesanan:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'in_progress' ? 'warning' : 'secondary') }}">
                            {{ str_replace('_', ' ', ucfirst($order->status)) }}
                        </span>
                    </p>
                    @if($order->joki)
                        <p><strong>Joki:</strong> {{ $order->joki->name }}</p>
                    @endif
                </div>
                <div class="col-md-6">
                    <h5>Detail Layanan</h5>
                    <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    
                    @if($order->deadline)
                        <p><strong>Target Selesai:</strong> 
                            {{ \Carbon\Carbon::parse($order->deadline)->format('d M Y H:i') }}
                        </p>
                    @else
                        <p><strong>Target Selesai:</strong> Belum ditentukan</p>
                    @endif
                    
                    <p><strong>Target Rank:</strong> {{ $order->target_rank }}</p>
                    <p><strong>Persyaratan:</strong> {{ $order->requirements }}</p>
                </div>
            </div>

            <!-- TAMBAHKAN BAGIAN REVIEW DI SINI -->
            @if($order->status === 'completed')
                @if($order->review)
                    <div class="alert alert-success mt-4">
                        <h5>Review Anda</h5>
                        <div class="d-flex align-items-center mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $order->review->rating)
                                    <i class="bi bi-star-fill text-warning fs-4"></i>
                                @else
                                    <i class="bi bi-star text-warning fs-4"></i>
                                @endif
                            @endfor
                        </div>
                        <p class="mb-0">{{ $order->review->comment }}</p>
                    </div>
                @else
                    <div class="alert alert-info mt-4">
                        <h5>Beri Review</h5>
                        <p>Pesanan Anda sudah selesai. Silakan berikan review untuk joki kami.</p>
                        <a href="{{ route('reviews.create', $order) }}" class="btn btn-success">
                            <i class="bi bi-star-fill"></i> Buat Review
                        </a>
                    </div>
                @endif
            @endif

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                @if($order->status === 'pending' && is_null($order->payment_proof))
                    <a href="{{ route('orders.payment', $order) }}" class="btn btn-primary">
                        Konfirmasi Pembayaran
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection