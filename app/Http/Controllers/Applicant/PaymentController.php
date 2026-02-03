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
        $applicant = Applicant::where('user_id', Auth::id())->firstOrFail();
        $amount = $applicant->category === 'general' ? 1000:500;
        return view('applicant.application.step1-payment', compact('applicant', 'amount'));
    }
}
