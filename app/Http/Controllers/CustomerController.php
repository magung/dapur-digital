<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->get();
        return view('customer.index', compact('customers'));
    }
    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required|unique:customers,email',
            'password'      => 'required',
            'phone_number'  => 'required',
            'gender'        => 'required',
            'birthday'      => 'required',
            'address'       => 'required',
            'status'        => 'required',
            'photo'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $photo = 'PHOTO-PROFILE-'.time().'.'.$request->photo->extension();

        $request->photo->move(public_path('uploads'), $photo);

        $customer = Customer::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'phone_number'  => $request->phone_number,
            'gender'        => $request->gender,
            'birthday'      => $request->birthday,
            'address'       => $request->address,
            'status'        => $request->status,
            'photo'         => $photo,
        ]);

        if ($customer) {
            return redirect()
                ->route('customer.index')
                ->with([
                    'success' => 'Sukses'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Gagal'
                ]);
        }
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required',
            'phone_number'  => 'required',
            'gender'        => 'required',
            'address'       => 'required',
            'status'       => 'required'
        ]);

        $datasend = [
            'name'          => $request->name,
            'email'         => $request->email,
            'phone_number'  => $request->phone_number,
            'gender'        => $request->gender,
            'birthday'      => $request->birthday,
            'address'       => $request->address,
            'status'       => $request->status,
        ];
        $customer = Customer::findOrFail($id);
        
        if(isset($request->photo)) {
            $photo = 'PHOTO-PROFILE-'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $photo);
            $datasend['photo'] = $photo;
            if (file_exists(public_path('uploads').'/'.$customer->photo)) {
                unlink(public_path('uploads').'/'.$customer->photo);
            } 
        }
        
        
        if(isset($request->pasword)) {
            $datasend['password'] = Hash::make($request->password);
        }
        
        $customer->update($datasend);

        if ($customer) {
            return redirect()
                ->route('customer.index')
                ->with([
                    'success' => 'Sukses'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Gagal'
                ]);
        }
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        if (file_exists(public_path('uploads').'/'.$customer->photo)) {
            unlink(public_path('uploads').'/'.$customer->photo);
        } 
        $customer->delete();
        
        if ($customer) {
            return redirect()
                ->route('customer.index')
                ->with([
                    'success' => 'Sukses'
                ]);
        } else {
            return redirect()
                ->route('customer.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
