<?php

namespace App\Providers;

use App\Models\Order;
use App\Policies\OrderPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Order::class => OrderPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Define admin role
        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });

        // Define joki role
        Gate::define('joki', function ($user) {
            return $user->role === 'joki';
        });
    }
}