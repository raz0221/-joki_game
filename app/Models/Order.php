<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'joki_id', // PASTIKAN INI ADA
        'game_id',
        'requirements',
        'deadline',
        'target_rank',
        'additional_notes',
        'status',
        'order_code',
        'total_price',
        'payment_proof',
        'paid_at',
        'completed_at' // PASTIKAN INI ADA
    ];
    protected $casts = [
    'deadline' => 'datetime',
    'paid_at' => 'datetime',
    'completed_at' => 'datetime',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function joki()
    {
        return $this->belongsTo(User::class, 'joki_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}