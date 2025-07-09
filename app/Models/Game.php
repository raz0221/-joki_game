<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'base_price'
    ];

    protected static function booted()
    {
        static::creating(function ($game) {
            $game->slug = Str::slug($game->name);
        });
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}