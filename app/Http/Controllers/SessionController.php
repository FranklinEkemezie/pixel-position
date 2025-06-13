<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    //

    public function show()
    {
        return view('auth.login');
    }

    public function create(Request $request)
    {
        $userAttrs = $request->validate([
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($userAttrs)) {
            return redirect()->back()->withErrors([
                'email' => 'Incorrect email or password'
            ])->withInput();
        }

        return redirect('/dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
