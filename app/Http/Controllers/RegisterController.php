<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function view(){
        return view('auth.register');
    }

    public function register(Request $request)
    {   
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required|unique:users,email',
            'password'      => 'required',
            'phone_number'  => 'required',
            'gender'        => 'required',
            'address'       => 'required',
            'photo'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $photo = 'PHOTO-PROFILE-'.time().'.'.$request->photo->extension();

        $request->photo->move(public_path('uploads'), $photo);

        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'role_id'       => 4,
            'phone_number'  => $request->phone_number,
            'gender'        => $request->gender,
            'birthday'      => $request->birthday,
            'address'       => $request->address,
            'status'        => 0,
            'photo'         => $photo,
        ]);

        if ($user) {
            return redirect()
                ->route('login')
                ->with([
                    'success' => 'Sukses Register, silakan hubungi admin Dapur Digital untuk mengaktifkan akun anda, kemudian login'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Gagal Register'
                ]);
        }
    }

}
