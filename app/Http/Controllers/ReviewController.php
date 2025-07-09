<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Order $order)
    {
        // PERBAIKAN: Tambahkan pengecekan status
        if ($order->status !== 'completed') {
            return redirect()->route('orders.show', $order)
                ->with('error', 'Hanya pesanan selesai yang bisa direview');
        }
        
        $this->authorize('review', $order);
        return view('reviews.create', compact('order'));
    }

    public function store(Order $order, Request $request)
    {
        // PERBAIKAN: Tambahkan pengecekan status
        if ($order->status !== 'completed') {
            return redirect()->route('orders.show', $order)
                ->with('error', 'Hanya pesanan selesai yang bisa direview');
        }
        
        $this->authorize('review', $order);
        
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        // PERBAIKAN: Cek apakah review sudah ada
        if ($order->review) {
            return redirect()->route('orders.show', $order)
                ->with('error', 'Anda sudah memberikan review untuk pesanan ini');
        }

        Review::create([
            'order_id' => $order->id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('orders.show', $order)->with('success', 'Ulasan berhasil disimpan');
    }
}