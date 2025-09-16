<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController
{

    public function __construct(protected UserService $userService ) {}

    public function index()
    {
        $query = $this->userService->getUsers();
        $query = $this->userService->whereRole($query, request()->input('role'));
        $query = $this->userService->whereActive($query, request()->input('is_active'));
        $query = $this->userService->search($query);

        $users = $this->userService->applyOrdering($query)
            ->simplePaginate($this->userService->perPage());

        $id = Auth::id();
        $ip = request()->ip();
        Log::info("User with ID {$id} accessed the users index page. IP: {$ip}");

        return view('users.index', ['users' => $users]);
    }

    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    public function create() {
        if (Auth::user()->role !== 'admin') {
            abort(403, "You dont have the permission to create users.");
        }
        return view('users.create');
    }

    public function edit(User $user)
    {
        if (Auth::user()->role != 'admin' && Auth::user()->id != $user->id) {
            abort(403, "You cannot edit this user.");
        }
        return view('users.edit', ['user' => $user]);
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $user = $this->userService->storeUser($request->validated());

            $id = Auth::id();
            $userCreatedId = $user->id;
            $ip = request()->ip();
            Log::info("User with ID {$id} created a new user with ID {$userCreatedId}. IP: {$ip}");

            return redirect()->route('users.show', ['user' => $user])
                ->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(User $user, ProfileUpdateRequest $request)
    {
        try {
            $user = $this->userService->updateUser($user, $request->validated());

            $id = Auth::id();
            $id_2 = $user->id;
            $ip = request()->ip();
            Log::info("User with ID {$id} changed profile for user with ID {$id_2}. IP: {$ip}");

            return redirect()->route('users.show', ['user' => $user])
                ->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();

            $id = Auth::id();
            $id_2 = $user->id;
            $ip = request()->ip();
            Log::info("User with ID {$id} deleted user with ID {$id_2}. IP: {$ip}");

            return redirect()->route('users.index')
                ->with('success', 'Recipient deleted successfully!');;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
