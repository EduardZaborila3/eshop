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

    public function scopeSearch($query)
    {
        if (!request()->filled('email')) {
            return $query;
        }

        return $query->where('email', 'LIKE', '%' . request()->input('email') . '%');
    }

    public function scopeOrder($query)
    {
        $allowedColumns = ['email', 'created_at'];
        $allowedDirections = ['asc', 'desc'];

        $column = request()->input('order_by');
        $direction = request()->input('direction');

        $column = in_array($column, $allowedColumns, true) ? $column : 'email';
        $direction = in_array(strtolower($direction), $allowedDirections, true) ? strtolower($direction) : 'asc';

        return $query->orderBy($column, $direction);
    }

    public function perPage()
    {
        return request()->input('per_page', 15);
    }

    public function scopeApplyAllFilters($query)
    {
        return $query
            ->search()
            ->order()
            ->paginate($this->perPage());
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
