<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function view(){
        $stores = Store::latest()->get();
        return view('auth.register')->with('stores', $stores);
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

        $user = Customer::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'phone_number'  => $request->phone_number,
            'gender'        => $request->gender,
            'birthday'      => $request->birthday,
            'address'       => $request->address,
            'status'        => 0,
            'photo'         => $photo,
            'store_id'      => $request->store_id
        ]);
        $phone_number_admin = "";
        if(isset($request->store_id)) {
            $phone_number_admin = Store::find($request->store_id)->phone_number;
        } else {
            $phone_number_admin = Store::latest()->first()->phone_number;
        }

        if ($user) {
            return redirect()
                ->route('login')
                ->with([
                    'success' => 'Sukses Register, silakan hubungi admin Dapur Digital untuk mengaktifkan akun anda, kemudian login',
                    'link_admin' => 'https://api.whatsapp.com/send/?phone='.$phone_number_admin
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

    public function view_admin(){
        return view('auth.register-admin');
    }

    // public function register_admin(Request $request)
    // {   
    //     $this->validate($request, [
    //         'name'          => 'required',
    //         'email'         => 'required|unique:users,email',
    //         'password'      => 'required',
    //         'phone_number'  => 'required',
    //         'gender'        => 'required',
    //         'address'       => 'required',
    //         'photo'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     $photo = 'PHOTO-PROFILE-'.time().'.'.$request->photo->extension();

    //     $request->photo->move(public_path('uploads'), $photo);

    //     $user = User::create([
    //         'name'          => $request->name,
    //         'email'         => $request->email,
    //         'password'      => Hash::make($request->password),
    //         'role_id'       => 4,
    //         'phone_number'  => $request->phone_number,
    //         'gender'        => $request->gender,
    //         'birthday'      => $request->birthday,
    //         'address'       => $request->address,
    //         'status'        => 0,
    //         'photo'         => $photo,
    //     ]);

    //     if ($user) {
    //         return redirect()
    //             ->route('login')
    //             ->with([
    //                 'success' => 'Sukses Register, silakan hubungi admin Dapur Digital untuk mengaktifkan akun anda, kemudian login'
    //             ]);
    //     } else {
    //         return redirect()
    //             ->back()
    //             ->withInput()
    //             ->with([
    //                 'error' => 'Gagal Register'
    //             ]);
    //     }
    // }

}
