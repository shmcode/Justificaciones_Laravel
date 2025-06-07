<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    protected function authenticated(Request $request, $user)
{
    if ($user->role === 'admin') {
        return redirect('/admin');
    } elseif ($user->role === 'professor') {
        return redirect('/professor');
    } else {
        return redirect('/student');
    }
}
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
    
public function store(LoginRequest $request): \Illuminate\Http\RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    $user = auth()->user();
    if ($user->role === 'admin') {
        return redirect('/admin');
    } elseif ($user->role === 'professor') {
        return redirect('/teacher');
    } else {
        return redirect('/student');
    }
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}