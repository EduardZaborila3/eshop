<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function __construct(protected UserService $userService) {}

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $user = $this->userService->getUserByEmail($request->email);
            if ($user->is_active != 1) {
                throw new \Exception("Login failed. The user you are trying to log in is inactive.");
            }

            $request->authenticate();

            $id = Auth::id();
            $ip = request()->ip();
            Log::info("User with ID {$id} logged in. IP: {$ip}");

            $request->session()->regenerate();

            return redirect()->intended(route('dashboard', absolute: false));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $id = Auth::id();
        $ip = request()->ip();
        Log::info("User with ID {$id} logged out. IP: {$ip}");

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
