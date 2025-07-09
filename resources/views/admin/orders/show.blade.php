@extends('layouts.app')

@section('title', 'Detail Pesanan Admin')

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
                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                    <p><strong>No. HP:</strong> {{ $order->user->phone ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Detail Pesanan</h5>
                    <p><strong>Game:</strong> {{ $order->game->name }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'in_progress' ? 'warning' : 'secondary') }}">
                            {{ str_replace('_', ' ', ucfirst($order->status)) }}
                        </span>
                    </p>
                    <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    <p><strong>Target Rank:</strong> {{ $order->target_rank }}</p> <!-- Perbaikan: target_rank bukan rank_target -->
                    <p><strong>Deadline:</strong> {{ $order->deadline ? $order->deadline->format('d M Y H:i') : 'N/A' }}</p>
                </div>
            </div>

            <div class="mb-4">
                <h5>Persyaratan</h5>
                <p>{{ $order->requirements }}</p>
            </div>

            @if($order->payment_proof)
                <div class="mb-4">
                    <h5>Bukti Pembayaran</h5>
                    <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Pembayaran" class="img-fluid rounded" style="max-height: 300px;">
                </div>
            @endif

            <!-- PERBAIKAN UTAMA: Formulir Assign Joki -->
            @if(in_array($order->status, ['paid', 'pending', 'in_progress']) && !$order->joki_id)
                <div class="mb-4">
                    <h5>Assign Joki</h5>
                    <form action="{{ route('admin.orders.assign-joki', $order) }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-8">
                                <select class="form-select" name="joki_id" required>
                                    <option value="" selected disabled>-- Pilih Joki --</option>
                                    @foreach($jokis as $joki)
                                        <option value="{{ $joki->id }}">{{ $joki->name }} - {{ $joki->game_specialty }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary w-100">Assign Joki</button>
                            </div>
                        </div>
                    </form>
                </div>
            @elseif($order->joki)
                <div class="mb-4">
                    <h5>Joki yang Ditugaskan</h5>
                    <p>{{ $order->joki->name }} ({{ $order->joki->game_specialty }})</p>
                    <p>Status: <span class="badge bg-info">{{ str_replace('_', ' ', $order->status) }}</span></p>
                </div>
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