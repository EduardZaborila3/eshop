<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getUsers()
    {
        return User::where('id', '!=', auth()->id());
    }
    public function perPage()
    {
        return request()->input('per_page', 15);
    }

    public function orderBy()
    {
        $allowed = ['email', 'created_at'];
        $col = request()->input('order_by', 'name');
        return in_array($col, $allowed, true) ? $col : 'name';
    }

    public function direction()
    {
        $dir = strtolower(request()->input('direction', 'asc'));
        return $dir === 'desc' ? 'desc' : 'asc';
    }

    public function applyOrdering($query)
    {
        $column = $this->orderBy();
        $dir = $this->direction();

        if ($column === 'name') {
            return $query->orderByRaw("name {$dir}");
        }

        return $query->orderBy($column, $dir);
    }


    public function whereRole($query, $role)
    {
        if ($role) {
            $query->where('role', $role);
        }
        return $query;
    }

    public function whereActive($query, $isActive)
    {
        if ($isActive != null && $isActive != '') {
            $query->where('is_active', $isActive);
        }
        return $query;
    }

    public function storeUser(): User
    {
        $address = request('street') . ' '
            . request('street_number') . ', '
            . request('city') . ' '
            . request('postcode') . ', '
            . request('country');

        return User::create([
            'name' => request('name'),
            'email' => request('email'),
            'phone' => request('phone'),
            'address_data' => $address,
            'role' => request('role'),
            'password' => Hash::make(request('password')),
            'is_active' => true,
        ]);


    }

    public function updateUser(User $user, array $data): User
    {
        $address = [
          'street' => $data['street'],
          'street_number' => $data['street_number'],
          'city' => $data['city'],
          'country' => $data['country'],
          'postcode' => $data['postcode']
        ];

         $user->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address_data' => $address,
            'role' => $data['role'],
            'is_active' => $data['is_active'],
        ]);

        return $user;
    }
}
