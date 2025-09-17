<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserIndexRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Nette\Schema\ValidationException;

class UserController
{
    //TODO Refactoring
    protected $query;
    public function __construct(protected UserService $userService) {
        $query = $this->userService->resetQuery();
    }

    public function index(UserIndexRequest $request)
    {
        try{
            $users = $this->userService->getFilteredUsers($request->validated());
            $this->userService->logInfo("accessed the users index page", Auth::id(), request()->ip());

            return view('users.index', ['users' => $users]);
        } catch (ValidationException $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }


    }

    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    public function create() {
        if (!$this->userService->checkAdmin(Auth::user())) {
            abort(403, "You dont have the permission to create users.");
        }
        return view('users.create');
    }

    public function edit(User $user)
    {
        if (!$this->userService->checkAdmin(Auth::user()) && Auth::user()->id != $user->id) {
            abort(403, "You are trying to do naughty things.");
        }
        return view('users.edit', ['user' => $user]);
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $user = $this->userService->storeUser($request->validated());

            $this->userService->logInfo("created a new user with ID {$user->id}", Auth::id(), request()->ip());

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

            $this->userService->logInfo("updated profile for user with ID {$user->id}", Auth::id(), request()->ip());

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

            $this->userService->logInfo("deleted user with ID {$user->id}", Auth::id(), request()->ip());

            return redirect()->route('users.index')
                ->with('success', 'Recipient deleted successfully!');;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
