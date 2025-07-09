@extends('layouts.app')

@section('title', 'Kelola Game')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Kelola Game</h1>
        <a href="{{ route('admin.games.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Game
        </a>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Game</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nama Game</th>
                            <th>Deskripsi</th>
                            <th>Harga Dasar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($games as $game)
                        <tr>
                            <td>{{ $game->name }}</td>
                            <td>{{ Str::limit($game->description, 50) }}</td>
                            <td>Rp {{ number_format($game->base_price, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.games.edit', $game) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('admin.games.destroy', $game) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $games->links() }}
            </div>
        </div>
    </div>
</div>
@endsection