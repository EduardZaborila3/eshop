<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable, softDeletes;

    protected $guarded = [];
    public $timestamps = false;

    public function products(): belongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function recipient(): belongsTo
    {
        return $this->belongsTo(Recipient::class);
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): belongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
