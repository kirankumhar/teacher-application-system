<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicantStep2Controller extends Controller
{
    public function create()
    {
        $applicant = Auth::user()->applicant; // relation
        return view('applicant.application.step2', compact('applicant'));
    }
}
