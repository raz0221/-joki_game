@extends('layouts.app')

@section('title', 'HAFTAP.Joki - Jasa Joki Game Profesional')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">HAFTAP<span class="text-primary">.Joki</span></h1>
        <p class="lead">Jasa Joki Game Profesional untuk Mobile Legends, PUBG Mobile, dan Free Fire</p>
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg mt-3">Daftar Sekarang</a>
    </div>

    <div class="row mb-5">
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <i class="bi bi-trophy display-1 text-primary mb-3"></i>
                    <h3 class="card-title">Joki Rank</h3>
                    <p class="card-text">Tingkatkan rank game Anda dengan bantuan joki profesional kami.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <i class="bi bi-shield-check display-1 text-primary mb-3"></i>
                    <h3 class="card-title">Aman & Terpercaya</h3>
                    <p class="card-text">Proses joki aman dengan jaminan uang kembali jika tidak puas.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <i class="bi bi-lightning display-1 text-primary mb-3"></i>
                    <h3 class="card-title">Cepat & Efisien</h3>
                    <p class="card-text">Proses cepat dengan tim profesional yang berpengalaman.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5">
        <h2 class="text-center mb-4">Layanan Kami</h2>
        <div class="row">
            @foreach($games as $game)
            <div class="col-md-4 mb-4">
                <div class="card game-card">
                    <div class="card-body text-center p-4">
                        <h3 class="card-title">{{ $game->name }}</h3>
                        <p class="card-text">{{ $game->description }}</p>
                        <p class="fw-bold">Mulai dari Rp {{ number_format($game->base_price, 0, ',', '.') }}</p>
                        <a href="{{ route('orders.create') }}" class="btn btn-outline-primary">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection