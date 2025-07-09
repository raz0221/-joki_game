@extends('layouts.app')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Daftar Pesanan Saya</h2>
        <a href="{{ route('orders.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Buat Pesanan Baru
        </a>
    </div>

    @if($orders->isEmpty())
        <div class="card">
            <div class="card-body text-center py-5">
                <h4 class="text-muted">Anda belum memiliki pesanan</h4>
                <p class="text-muted">Mulai buat pesanan joki pertama Anda</p>
                <a href="{{ route('orders.create') }}" class="btn btn-primary mt-3">Buat Pesanan</a>
            </div>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Kode Pesanan</th>
                        <th>Game</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->order_code }}</td>
                        <td>{{ $order->game->name }}</td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>
                            <span class="status-badge status-{{ $order->status }}">
                                {{ str_replace('_', ' ', ucfirst($order->status)) }}
                            </span>
                        </td>
                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection