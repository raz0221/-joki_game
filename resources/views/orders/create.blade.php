@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Buat Pesanan Joki</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Pilih Game</label>
                    <select class="form-select" name="game_id" required>
                        <option value="" selected disabled>- Pilih Game -</option>
                        @foreach($games as $game)
                            <option value="{{ $game->id }}" 
                                data-price="{{ $game->base_price }}">
                                {{ $game->name }} (Rp {{ number_format($game->base_price, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                    @error('game_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Persyaratan (ID Game, Nickname, dll)</label>
                    <textarea class="form-control" name="requirements" rows="3" required></textarea>
                    @error('requirements')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Target Selesai</label>
                    <input type="datetime-local" 
                           class="form-control" 
                           name="deadline" 
                           id="deadline"
                           min="{{ now()->addDay()->format('Y-m-d\TH:i') }}"
                           required>
                    @error('deadline')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Minimal besok hari</small>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Target Rank</label>
                    <input type="text" class="form-control" name="target_rank" required>
                    @error('target_rank')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Catatan Tambahan</label>
                    <textarea class="form-control" name="additional_notes" rows="2"></textarea>
                </div>
                
                <div class="mb-4 p-3 bg-light rounded">
                    <h5>Total Harga: <span id="totalPrice">Rp 0</span></h5>
                </div>
                
                <button type="submit" class="btn btn-primary">Buat Pesanan</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Validasi client-side untuk deadline
    document.getElementById('orderForm').addEventListener('submit', function(e) {
        const deadlineInput = document.getElementById('deadline');
        const deadlineDate = new Date(deadlineInput.value);
        const now = new Date();
        
        // Set waktu minimum menjadi besok
        const minDate = new Date();
        minDate.setDate(minDate.getDate() + 1);
        
        if (deadlineDate < minDate) {
            e.preventDefault();
            alert('Deadline harus minimal besok hari');
            deadlineInput.focus();
        }
    });

    // Update harga saat game dipilih
    document.querySelector('select[name="game_id"]').addEventListener('change', function() {
        const price = this.options[this.selectedIndex].dataset.price;
        document.getElementById('totalPrice').textContent = 'Rp ' + 
            new Intl.NumberFormat('id-ID').format(price);
    });
</script>
@endsection