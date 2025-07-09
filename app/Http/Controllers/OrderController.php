<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator; // Tambahkan ini

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->with('game')->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $games = Game::all();
        return view('orders.create', compact('games'));
    }

    public function store(Request $request)
    {
        // Perbaikan validasi: Gunakan array rule yang benar
        $validator = Validator::make($request->all(), [
            'game_id' => 'required|exists:games,id',
            'requirements' => 'required|string',
            'deadline' => 'required|date|after:today', // Perbaikan di sini
            'target_rank' => 'required|string',
        ]);

        // Jika validasi gagal, kembali dengan error
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Dapatkan game yang dipilih
        $game = Game::find($request->game_id);
        
        // Jika game tidak ditemukan, kembalikan error
        if (!$game) {
            return back()->withErrors(['game_id' => 'Game tidak ditemukan'])->withInput();
        }

        $orderCode = 'ORD-' . Str::upper(Str::random(8)) . '-' . date('Ymd');

        $order = Order::create([
            'user_id' => auth()->id(),
            'game_id' => $request->game_id,
            'requirements' => $request->requirements,
            'deadline' => $request->deadline,
            'target_rank' => $request->target_rank,
            'additional_notes' => $request->additional_notes,
            'status' => 'pending',
            'order_code' => $orderCode,
            'total_price' => $game->base_price, // Gunakan base_price dari game
        ]);

        return redirect()->route('orders.payment', $order);
    }

   public function show(Order $order)
    {
         $this->authorize('view', $order);
    
    // PERBAIKAN: Load relasi review
        $order->load('review');
    
        return view('orders.show', compact('order'));
    }

    public function payment(Order $order)
    {
        $this->authorize('update', $order);
        return view('orders.payment', compact('order'));
    }

    public function confirmPayment(Order $order, Request $request)
    {
        $this->authorize('update', $order);
        
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');
            $order->update([
                'status' => 'paid',
                'payment_proof' => $path,
                'paid_at' => now(),
            ]);
        }

        return redirect()->route('orders.show', $order)->with('success', 'Pembayaran berhasil dikonfirmasi');
    }
}