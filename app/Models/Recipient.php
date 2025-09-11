<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Recipient extends Model
{
    use HasFactory, Notifiable, softDeletes;

    protected $guarded = [];

    protected $casts = [
        'name' => 'encrypted',
        'phone' => 'encrypted',
        'address_data' => 'array',
        'notes' => 'encrypted'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
