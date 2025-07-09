<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome()
    {
        $games = Game::all();
        return view('welcome', compact('games'));
    }

    public function index()
    {
        $user = auth()->user();
        
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'joki') {
            return redirect()->route('joki.dashboard');
        } else {
            return redirect()->route('orders.index');
        }
    }
}