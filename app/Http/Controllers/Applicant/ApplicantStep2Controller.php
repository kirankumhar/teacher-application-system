<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicant;
use Carbon\Carbon;

class ApplicantStep2Controller extends Controller
{
    public function create()
    {
        $applicant = Applicant::where('user_id', auth()->id())->firstOrFail();
        $dob = Carbon::parse($applicant->dob);
        $asOnDate = Carbon::create(2024, 1, 1);
        $age = $dob->diff($asOnDate);

        if ($applicant->application_step < 2) {
            return redirect()->route('applicant.dashboard');
        }

        return view('applicant.application.step2', compact('applicant', 'age'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address'=> 'required',
            'id_proof_type' => 'required',
            
        ]);
    }
}
