<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Company extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    protected $casts = [
        'address' => 'array',
        'is_active' => 'boolean',
    ];

    public function products(): hasMany {
        return $this->hasMany(Product::class);
    }

    public function orders(): hasMany {
        return $this->hasMany(Order::class);
    }
}
