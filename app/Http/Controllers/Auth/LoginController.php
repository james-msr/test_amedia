<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function login(Request $request): View|RedirectResponse
    {
        $data = $request->all();
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
