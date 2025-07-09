@extends('layouts.app')

@section('title', 'Beri Review')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Beri Review untuk Pesanan #{{ $order->order_code }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('reviews.store', $order) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Rating</label>
                    <div class="rating">
                        @for($i = 5; $i >= 1; $i--)
                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                            <label for="star{{ $i }}"><i class="bi bi-star"></i></label>
                        @endfor
                    </div>
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">Komentar (Opsional)</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" maxlength="500"></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Kirim Review</button>
            </form>
        </div>
    </div>
</div>

<style>
    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }
    .rating input {
        display: none;
    }
    .rating label {
        font-size: 2rem;
        color: #ddd;
        cursor: pointer;
    }
    .rating input:checked ~ label {
        color: #ffc107;
    }
    .rating label:hover,
    .rating label:hover ~ label {
        color: #ffc107;
    }
</style>
@endsection