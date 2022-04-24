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
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request): View|RedirectResponse
    {
        $data = $request->validated();
        if (auth()->attempt($data)) {
            if (auth()->user()->role == User::ROLE['manager']) {
                return view('application.index');
            }
            return view('application.form');
        }
        return back()->withErrors([
            'message' => 'Incorrect email or password.'
        ]);
    }
}
