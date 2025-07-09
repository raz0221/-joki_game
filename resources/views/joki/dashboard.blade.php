@extends('layouts.app')

@section('title', 'Dashboard Joki')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Dashboard Joki</h1>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Pesanan Aktif</h5>
                    <h2 class="card-text">{{ $assignedOrders->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Pesanan Selesai</h5>
                    <h2 class="card-text">{{ $completedOrders->count() }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Pesanan Aktif</h5>
        </div>
        <div class="card-body">
            @if($assignedOrders->isEmpty())
                <div class="alert alert-info">
                    Tidak ada pesanan aktif.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Kode Pesanan</th>
                                <th>Game</th>
                                <th>Customer</th>
                                <th>Deadline</th>
                                <th>Status</th> <!-- Kolom Baru: Status -->
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assignedOrders as $order)
                            <tr>
                                <td>{{ $order->order_code }}</td>
                                <td>{{ $order->game->name ?? 'N/A' }}</td>
                                <td>{{ $order->user->name ?? 'N/A' }}</td>
                                <td>{{ $order->deadline ? $order->deadline->format('d M Y H:i') : 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-warning text-dark">
                                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('joki.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Pesanan Terakhir Selesai</h5>
        </div>
        <div class="card-body">
            @if($completedOrders->isEmpty())
                <div class="alert alert-info">
                    Belum ada pesanan selesai.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Kode Pesanan</th>
                                <th>Game</th>
                                <th>Customer</th>
                                <th>Selesai Pada</th>
                                <th>Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($completedOrders as $order)
                            <tr>
                                <td>{{ $order->order_code }}</td>
                                <td>{{ $order->game->name ?? 'N/A' }}</td>
                                <td>{{ $order->user->name ?? 'N/A' }}</td>
                                <td>{{ $order->completed_at ? $order->completed_at->format('d M Y H:i') : 'N/A' }}</td>
                                <td>
                                    @if($order->review)
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $order->review->rating)
                                                <i class="bi bi-star-fill text-warning"></i>
                                            @else
                                                <i class="bi bi-star text-warning"></i>
                                            @endif
                                        @endfor
                                    @else
                                        <span class="text-muted">Belum ada review</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection