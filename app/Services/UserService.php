<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService
{
    protected $query;
    public function __construct()
    {
        $this->query = User::query();
    }

    public function resetQuery(): self
    {
        $this->query = User::query();
        return $this;
    }

    public function checkAdmin($user)
    {
        return $user->role === 'admin' ? 1 : 0;
    }

    public function getFilteredUsers(array $filters)
    {
        return User::query()
            ->excludeCurrent()
            ->applyAllFilters(
                $filters['order_by'] ?? 'email',
                $filters['order'] ?? 'asc',
            );
    }

    public function logInfo($message, $id, $ip)
    {
        Log::info("User with ID {$id} " . $message . ". IP: {$ip}");
    }

    public function storeUser(array $data): User
    {
        $address = [
          'street' => $data['street'],
          'street_number' => $data['street_number'],
          'city' => $data['city'],
          'postcode' => $data['postcode'],
          'country' => $data['country'],
        ];

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address_data' => $address,
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
            'is_active' => $data['is_active'] ?? true,
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
