<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function direction()
    {
        return request()->input('direction', 'asc');
    }
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
        return request()->input('order_by', 'name');
    }

    public function whereRole($query, $role)
    {
        if ($role) {
            $query->where('role', $role);
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
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address_data' => $address,
            'role' => $data['role'],
            'is_active' => $data['is_active'],
        ]);

        return $user;
    }
}
