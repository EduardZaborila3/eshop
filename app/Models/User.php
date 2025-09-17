<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'name' => 'encrypted',
        'phone' => 'encrypted',
        'address_data' => 'array',
        'password' => 'hashed',
    ];

    public function orders(): hasMany
    {
        return $this->hasMany(Order::class);
    }

    public function scopeExcludeCurrent($query)
    {
        return $query->where('id', '!=', auth()->id());
    }

    public function scopeSearch($query)
    {
        if (!request()->filled('email')) {
            return $query;
        }

        return $query->where('email', 'LIKE', '%' . request()->input('email') . '%');
    }

    public function scopeFilter($query)
    {
        if (in_array(request()->input('role'), ['admin', 'user'], true)) {
            return $query->where('role', request()->input('role'));
        } else if (in_array(request()->input('is_active'), [1, 0, '1', '0'], true)) {
            return $query->where('is_active', request()->input('is_active'));
        }

        return $query;
    }

    public function scopeOrder($query)
    {
        $column = request()->input('order_by', 'created_at');
        $direction = request()->input('direction', 'asc');

        return $query->orderBy($column, $direction);
    }

    public function perPage()
    {
        return request()->input('per_page', 15);
    }

    public function scopeApplyAllFilters($query)
    {
        return $query->excludeCurrent()
            ->search()
            ->filter()
            ->order()
            ->paginate($this->perPage());
    }
}
