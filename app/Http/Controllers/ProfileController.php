<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $profile = Auth::user();
        $roles =  Role::latest()->get();
        $stores = Store::latest()->get();
        return view('profile.index', compact('profile', 'roles', 'stores'));
    }

    public function update(Request $request, $id){
        
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required',
            'role_id'       => 'required',
            'phone_number'  => 'required',
            'gender'        => 'required',
            'address'       => 'required'
        ]);

        $datasend = [
            'name'          => $request->name,
            'email'         => $request->email,
            'role_id'       => $request->role_id,
            'phone_number'  => $request->phone_number,
            'gender'        => $request->gender,
            'birthday'      => $request->birthday,
            'address'       => $request->address,
            'store_id'      => $request->store_id,
        ];
        $user = User::findOrFail($id);
        
        if(isset($request->photo)) {
            $photo = 'PHOTO-PROFILE-'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $photo);
            $datasend['photo'] = $photo;
            if (file_exists(public_path('uploads').'/'.$user->photo)) {
                unlink(public_path('uploads').'/'.$user->photo);
            } 
        }
        
        
        if(isset($request->pasword)) {
            $datasend['password'] = Hash::make($request->password);
        }
        
        $user->update($datasend);

        if ($user) {
            return redirect()
                ->route('profile.index')
                ->with([
                    'success' => 'profile has been updated successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem has occured, please try again'
                ]);
        }
    }
}
