<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable, softDeletes;

    protected $guarded = [];

    public function company(): belongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function orders(): belongsToMany
    {
        return $this->belongsToMany(Order::class);
    }


}
