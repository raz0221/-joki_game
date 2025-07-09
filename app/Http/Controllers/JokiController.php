<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Http\Request;

class JokiController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        
        // Perbaikan 1: Gunakan whereIn untuk semua status aktif
        $assignedOrders = $user->jokiOrders()
            ->with(['user', 'game']) // Eager load relasi
            ->whereIn('status', ['in_progress', 'dalam_pengerjaan', 'assigned'])
            ->get();
            
        $completedOrders = $user->jokiOrders()
            ->with(['user', 'game']) // Eager load relasi
            ->where('status', 'completed')
            ->latest()
            ->take(5)
            ->get();
        
        return view('joki.dashboard', compact('assignedOrders', 'completedOrders'));
    }

    public function orders()
    {
        $orders = Auth::user()->jokiOrders()
            ->with(['user', 'game'])
            ->latest()
            ->paginate(10);
            
        return view('joki.orders.index', compact('orders'));
    }

    public function showOrder(Order $order)
    {
        $this->authorize('view', $order);
        return view('joki.orders.show', compact('order'));
    }

    public function completeOrder(Order $order)
    {
        $this->authorize('update', $order);
        
        $order->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        return redirect()->route('joki.dashboard')->with('success', 'Pesanan telah diselesaikan');
    }

        public function __construct()
{
    $this->middleware('auth');
    $this->middleware(function ($request, $next) {
        // Cek role manual
        if (auth()->user()->role !== 'joki') {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    });
}
}