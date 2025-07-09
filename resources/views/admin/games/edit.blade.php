@extends('layouts.app')

@section('title', 'Edit Game')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Game - {{ $game->name }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.games.update', $game) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Game</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $game->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ $game->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="base_price" class="form-label">Harga Dasar</label>
                    <input type="number" class="form-control" id="base_price" name="base_price" value="{{ $game->base_price }}" min="0" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.games.index') }}" class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection