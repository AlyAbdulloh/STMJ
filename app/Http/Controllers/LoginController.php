<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {

        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $role = "user";
        $getData = User::where('username', $request->get('username'))->first();
        if ($getData != null) {
            $role = $getData->role;
        }

        if (Auth::attempt($credentials)) {
            if ($role == 'admin') {
                $request->session()->regenerate();

                return redirect()->intended('/');
            }
            // $request->session()->regenerate();

            // return redirect()->intended('/home');
        }

        return back()->with('failed', 'Check your data!');
    }
}
