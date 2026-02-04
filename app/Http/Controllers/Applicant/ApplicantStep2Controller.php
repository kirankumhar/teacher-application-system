<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicant;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Education;

class ApplicantStep2Controller extends Controller
{
    public function create()
    {
        $applicant = Applicant::where('user_id', auth()->id())->firstOrFail();
        $dob = Carbon::parse($applicant->dob);
        $asOnDate = Carbon::create(2024, 1, 1);
        $age = $dob->diff($asOnDate);

        if ($applicant->application_step < 2) {
            return redirect()->route('applicant.payment.step1');
        }

        if ($applicant->application_step >= 3) {
            return redirect()->route('applicant.step3');
        }

        return view('applicant.application.step2', compact('applicant', 'age'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address'       => 'required|max:255',
            'id_proof_type' => 'required|in:aadhaar,pan',
            'id_proof_no'   => 'required|max:50',

            'grad_board'    => 'required|string',
            'grad_subject'  => 'required|string',
            'grad_year'     => 'required|digits:4',
            'grad_marks'    => 'required|numeric|between:0,500',
            'grad_cert_no'  => 'nullable|string',
        ]);

        $applicant = Applicant::where('user_id', Auth::id())->firstOrFail();

        
        $applicant->update([
            'address'           => $request->address,
            'aadhaar_pan_type'  => $request->id_proof_type,
            'aadhaar_pan_no'    => $request->id_proof_no,
            'application_step'  => 3,
        ]);

        $percent = round(($request->grad_marks / 500) * 100, 2);

        
        if ($percent >= 60) {
            $division = 'First';
        } elseif ($percent >= 45) {
            $division = 'Second';
        } else {
            $division = 'Third';
        }

        Education::updateOrCreate(
            [
                'applicant_id' => $applicant->id,
                'level' => 'graduation',
            ],
            [
                'board_university' => $request->grad_board,
                'subjects'         => $request->grad_subject,
                'year_of_passing'  => $request->grad_year,
                'marks_obtained'   => $request->grad_marks,
                'division'         => $division,
                'certificate_no'   => $request->grad_cert_no,
            ]
        );

        return redirect()
            ->route('applicant.step3')
            ->with('success', 'Step-2 completed successfully');
    }

}
