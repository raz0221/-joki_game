@extends('layouts.app')

@section('title', 'Layanan Joki Game')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Layanan Joki Game</h1>
    <p class="lead mb-5">Pilih game yang ingin Anda naikkan ranknya dengan bantuan joki profesional kami</p>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($games as $game)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $game->name }}</h5>
                    @if($game->description)
                        <p class="card-text">{{ $game->description }}</p>
                    @endif
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="text-primary fw-bold">Rp {{ number_format($game->base_price, 0, ',', '.') }}</span>
                        <a href="{{ route('orders.create') }}?game_id={{ $game->id }}" class="btn btn-primary btn-sm">
                            Pesan Joki
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-5 bg-light p-4 rounded">
        <h3>Mengapa Memilih Jasa Kami?</h3>
        <div class="row mt-4">
            <div class="col-md-4 mb-3">
                <div class="text-center p-3">
                    <i class="bi bi-shield-check fs-1 text-primary"></i>
                    <h5 class="mt-2">Aman & Terpercaya</h5>
                    <p class="mb-0">Proses joki aman dengan jaminan uang kembali jika tidak puas</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="text-center p-3">
                    <i class="bi bi-lightning fs-1 text-primary"></i>
                    <h5 class="mt-2">Cepat & Efisien</h5>
                    <p class="mb-0">Proses cepat dengan tim profesional yang berpengalaman</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="text-center p-3">
                    <i class="bi bi-headset fs-1 text-primary"></i>
                    <h5 class="mt-2">Dukungan 24/7</h5>
                    <p class="mb-0">Customer service siap membantu Anda kapan saja</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@if(!function_exists('icon'))
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
@endpush
@endif