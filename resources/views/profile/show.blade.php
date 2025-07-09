@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Profil Pengguna</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 text-center">
                    <div class="bg-light rounded-circle p-4 mb-3">
                        <i class="bi bi-person-circle" style="font-size: 4rem;"></i>
                    </div>
                    <h5>{{ $user->name }}</h5>
                    <span class="badge bg-primary">{{ ucfirst($user->role) }}</span>
                </div>
                <div class="col-md-9">
                    <div class="mb-3">
                        <label class="form-label text-muted">Nama Lengkap</label>
                        <p class="form-control-plaintext">{{ $user->name }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Email</label>
                        <p class="form-control-plaintext">{{ $user->email }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Tanggal Daftar</label>
                        <p class="form-control-plaintext">{{ $user->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection