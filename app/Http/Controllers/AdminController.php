<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Game;
use Illuminate\Http\Request;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Log; // Tambahkan ini untuk logging

class AdminController extends Controller
{
    public function dashboard()
    {
        $orders = Order::with(['user', 'game'])->latest()->paginate(10);
        $totalOrders = Order::count();
        $completedOrders = Order::where('status', 'completed')->count();
        $activeJokis = User::where('role', 'joki')->count();
        $revenue = Order::where('status', 'completed')->sum('total_price');
        
        return view('admin.dashboard', compact(
            'orders', 
            'totalOrders', 
            'completedOrders', 
            'activeJokis', 
            'revenue'
        ));
    }

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(\App\Http\Middleware\RoleMiddleware::class . ':admin');
    }

    public function manageOrders()
    {
        $orders = Order::with(['user', 'game'])->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function assignJoki(Order $order, Request $request)
    {
        $request->validate([
            'joki_id' => 'required|exists:users,id',
        ]);

        $joki = User::find($request->joki_id);
        if ($joki->role !== 'joki') {
            return back()->with('error', 'User yang dipilih bukan joki!');
        }

        // PERBAIKAN UTAMA: Gunakan properti langsung
        $order->joki_id = $request->joki_id;
        $order->status = 'in_progress';
        
        // Simpan perubahan
        if ($order->save()) {
            Log::info('Joki assigned successfully', [
                'order_id' => $order->id,
                'joki_id' => $request->joki_id
            ]);
            return back()->with('success', 'Joki berhasil ditugaskan');
        } else {
            Log::error('Failed to assign joki', [
                'order_id' => $order->id,
                'joki_id' => $request->joki_id
            ]);
            return back()->with('error', 'Gagal menyimpan perubahan!');
        }
    }

    public function manageUsers()
    {
        $users = User::where('role', '!=', 'admin')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function manageGames()
    {
        $games = Game::paginate(10);
        return view('admin.games.index', compact('games'));
    }
    
    public function show(Order $order)
    {
        $jokis = User::where('role', 'joki')->get();
        return view('admin.orders.show', compact('order', 'jokis'));
    }
}