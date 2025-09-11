<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController
{
    public function index()
    {
        $users = User::all();

        return view('users.index', ['users' => $users]);
    }

    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    public function create() {
        return view('users.create');
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(User $user)
    {
        request()->validate([
            'name' => ['required', 'min:3'],
            'phone' => ['required', 'min:9'],
            'street' => ['required', 'min:3'],
            'street_number' => ['required', 'numeric'],
            'city' => ['required', 'min:3'],
            'postcode' => ['required', 'min:4'],
            'country' => ['required', 'min:3'],
            'role' => ['required'],
            'is_active' => ['boolean'],
        ]);

        $user->update([
            'name' => request('name'),
            'phone' => request('phone'),
            'address_data' => [
                'street' => request('street'),
                'street_number' => request('street_number'),
                'city' => request('city'),
                'postcode' => request('postcode'),
                'country' => request('country')
            ],
            'role' => request('role'),
            'is_active' => request('is_active')
        ]);

        return redirect("/users/{$user->id}");
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/users');
    }
}
