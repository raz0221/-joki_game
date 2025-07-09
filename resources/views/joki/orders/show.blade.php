@extends('layouts.app')

@section('title', 'Detail Pesanan Joki')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Detail Pesanan - {{ $order->order_code }}</h4>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Informasi Customer</h5>
                    <p><strong>Nama:</strong> {{ $order->user->name }}</p>
                    <p><strong>No. HP:</strong> {{ $order->user->phone ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Detail Pesanan</h5>
                    <p><strong>Game:</strong> {{ $order->game->name }}</p>
                    <p><strong>Status:</strong> 
                        <span class="status-badge status-{{ $order->status }}">
                            {{ str_replace('_', ' ', ucfirst($order->status)) }}
                        </span>
                    </p>
                    <p><strong>Target Rank:</strong> {{ $order->rank_target }}</p>
                    <p><strong>Deadline:</strong> {{ $order->deadline->format('d M Y H:i') }}</p>
                </div>
            </div>

            <div class="mb-4">
                <h5>Persyaratan</h5>
                <p>{{ $order->requirements }}</p>
            </div>

            @if($order->status == 'in_progress')
                <form action="{{ route('joki.orders.complete', $order) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success w-100">Tandai Selesai</button>
                </form>
            @endif

            @if($order->review)
                <div class="mt-4">
                    <h5>Review Customer</h5>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $order->review->rating)
                                        <i class="bi bi-star-fill text-warning"></i>
                                    @else
                                        <i class="bi bi-star text-warning"></i>
                                    @endif
                                @endfor
                            </div>
                            <p>{{ $order->review->comment }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection