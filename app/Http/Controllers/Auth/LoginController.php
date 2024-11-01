<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
{

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    
    
    if (Auth::attempt($request->only('email', 'password'))) {
        $user = Auth::user();
        
        if ($user->level == 'admin') {
            // dd('berhasil', $user->level);
            return redirect()->route('dashboard.admin')->with('success', 'Login berhasil.');
        } else {
            return redirect()->route('customer.menu')->with('success', 'Login berhasil.');
        }
    }
    return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');

}

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout berhasil.');
    }
}
