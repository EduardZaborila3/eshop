<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController
{
    public function index()
    {
        $users = User::all();

        return view('components.users.index', ['users' => $users]);
    }

    public function show(User $user)
    {
        return view('components.users.show', ['user' => $user]);
    }
}
