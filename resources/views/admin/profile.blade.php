@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header bg-danger text-white">
            <h4 class="mb-0">Admin Profile</h4>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="text-center">
                        <img src="{{ asset('images/admin-avatar.png') }}" class="img-fluid rounded-circle mb-3" alt="Avatar" style="max-width: 150px;">
                        <h5>{{ $user->name }}</h5>
                        <p class="text-muted">Administrator</p>
                    </div>
                </div>
                
                <div class="col-md-9">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Terdaftar Sejak:</strong> {{ $user->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    
                    <div class="border-top pt-3">
                        <h5>Hak Akses Administrator</h5>
                        <!-- Tambahkan informasi khusus admin di sini -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection