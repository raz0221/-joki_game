<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Order $order)
    {
        return $user->id === $order->user_id || 
               $user->id === $order->joki_id || 
               $user->role === 'admin';
    }

    public function update(User $user, Order $order)
    {
        return $user->id === $order->user_id || 
               $user->role === 'admin' || 
               $user->role === 'joki';
    }

    public function review(User $user, Order $order)
    {
        return $user->id === $order->user_id && 
               $order->status === 'completed' && 
               is_null($order->review);
    }
}