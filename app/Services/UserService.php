<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
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
}
