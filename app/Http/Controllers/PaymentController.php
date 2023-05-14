<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::latest()->get();
        return view('payment.index', compact('payments'));
    }
    public function create()
    {
        return view('payment.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'payment_method' => 'required'
        ]);

        $payment = Payment::create([
            'payment_method' => $request->payment_method
        ]);

        if ($payment) {
            return redirect()
                ->route('payment.index')
                ->with([
                    'success' => 'New payment has been created successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        return view('payment.edit', compact('payment'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'payment_method' => 'required'
        ]);

        $payment = Payment::findOrFail($id);

        $payment->update([
            'payment_method' => $request->payment_method
        ]);

        if ($payment) {
            return redirect()
                ->route('payment.index')
                ->with([
                    'success' => 'Payment has been updated successfully'
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

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        if ($payment) {
            return redirect()
                ->route('payment.index')
                ->with([
                    'success' => 'payment has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('payment.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
