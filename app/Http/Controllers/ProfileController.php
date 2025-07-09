<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        // Tampilkan view sesuai role
        switch ($user->role) {
            case 'admin':
                return view('admin.profile', compact('user'));
            case 'joki':
                return view('joki.profile', compact('user'));
            default: // customer dan lainnya
                return view('customer.profile', compact('user'));
        }
    }
}