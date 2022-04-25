<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function loginForm(): View
    {
        return view('auth.login_form');
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if (auth()->attempt($data)) {
            if (auth()->user()->isManager()) {
                return redirect()->route('application.index');
            }
            return redirect()->route('application.create');
        }
        return back()->with([
            'error' => 'Incorrect email or password.'
        ]);
    }
}
