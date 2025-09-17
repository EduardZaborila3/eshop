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

    public const CURRENCIES = ['EUR', 'USD', 'RON'];

    protected $guarded = [];

    public function getRouteKeyName(): string
    {
        return 'sku';
    }

    public function scopeSearch($query)
    {
        if (!request()->filled('name')) {
            return $query;
        }

        return $query->where('name', 'LIKE', '%' . request()->input('name') . '%');
    }

    public function scopeFilter($query)
    {
        if (in_array(request()->input('is_active'), [1, 0, '1', '0'], true)) {
            return $query->where('is_active', request()->input('is_active'));
        }

        return $query;
    }

    public function scopeOrder($query)
    {
        $allowedColumns = ['newest', 'name', 'price'];
        $allowedDirections = ['asc', 'desc'];

        $column = request()->input('order_by');
        $direction = request()->input('direction');

        $column = in_array($column, $allowedColumns, true) ? $column : 'newest';
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
            ->filter()
            ->order()
            ->paginate($this->perPage());
    }

    public function company(): belongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function orders(): belongsToMany
    {
        return $this->belongsToMany(Order::class);
    }


}
