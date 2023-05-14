<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function view(){
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {   
        $request->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ]);
        $user = User::where('email', $request->email)->first();
        if($user != null) {
            if ($user->status == 0) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with([
                        'error' => 'akun belum aktif silakan hubungi admin Dapur Digital'
                    ]);
            }
        }
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
    
        return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'email atau Password salah'
                ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
