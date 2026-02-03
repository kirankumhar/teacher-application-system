<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\ApplicationPayment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function create()
    {
        $applicant = Applicant::where('user_id', auth()->id())->firstOrFail();
        if ($applicant->application_step >= 2) {
            return redirect()->route('applicant.step2');
        }
        $amount = $applicant->category === 'general' ? 1000:500;
        return view('applicant.application.step1-payment', compact('applicant', 'amount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_name'   => 'required|string',
            'payment_ref' => 'required|string',
            'payment_date'=> 'required|date',
            'receipt'     => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $applicant = Applicant::where('user_id', Auth::id())->firstOrFail();

        $path = $request->file('receipt')->store('payment-receipts', 'public');

        ApplicationPayment::create([
            'applicant_id' => $applicant->id,
            'bank_name'    => $request->bank_name,
            'amount'       => $applicant->category === 'general' ? 1000 : 500,
            'payment_ref'  => $request->payment_ref,
            'payment_date' => $request->payment_date,
            'receipt'      => $path,
            'status'       => 'pending',
        ]);

        $applicant->application_step = 2;
        $applicant->save();

        return redirect()->route('applicant.step2')
            ->with('success', 'Payment details submitted successfully');

    }

}
