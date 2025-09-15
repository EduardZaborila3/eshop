<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Services\UserService;

class UserController
{

    public function __construct(protected UserService $userService ) {}

    public function index()
    {
        $query = $this->userService->getUsers();
        $query = $this->userService->whereRole($query, request()->input('role'));
        $query = $this->userService->whereActive($query, request()->input('is_active'));

        $users = $this->userService->applyOrdering($query)
            ->simplePaginate($this->userService->perPage());

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

    public function update(User $user, ProfileUpdateRequest $request)
    {
        $user = $this->userService->updateUser($user, $request->validated());

        return redirect()->route('users.show', ['user' => $user])
            ->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/users');
    }
}
