<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\ApplicantDocument;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ApplicantStep3Controller extends Controller
{
    public function create()
    {
        $applicant = Applicant::where('user_id', auth()->id())->firstOrFail();
        if($applicant->application_step < 3) { 
            return redirect()->route('applicant.step2');
        }

        if($applicant->application_step >= 4){
            return redirect()->route('applicant.preview');
        }

        return view('applicant.application.step3', compact('applicant'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo'       => 'required|image|max:2048',
            'signature'   => 'required|image|max:2048',
            'dob_proof'   => 'required|file|mimes:pdf,jpg,png|max:2048',
            'id_proof'    => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $applicant = Applicant::where('user_id', auth()->id())->firstOrFail();

        $document = [
            'photo',
            'signature',
            'dob_proof',
            'id_proof',
        ];

        foreach( $document as $doc ){
            if($request->hasFile($doc)){
                $path = $request->file($doc)->store("documents/{$doc}", 'public');

                ApplicantDocument::updateOrCreate(
                    [
                        'applicant_id' => $applicant->id,
                        'document_type' => $doc,
                    ],
                    [
                        'file_path' => $path,
                    ]
                );
            }
        }

        $applicant->update([
            'application_step' => 4,
        ]);

        return redirect()
        ->route('applicant.preview')
        ->with('success', 'documents upload successfully');
    }

    public function view()
    {
        $applicant = Applicant::with(['user', 'educations', 'documents'])
        ->where('user_id', Auth::id())
        ->firstOrFail();

        if($applicant->application_step < 4){
            return redirect()->route('applicant.step3');
        }
        

        return view('applicant.application.preview', compact('applicant'));
    }

    public function finalSubmit()
    {
        $applicant = Applicant::where('user_id', auth()->id())->firstOrFail();

        if ($applicant->application_step < 4) {
            return redirect()->route('applicant.step3');
        }
        $ackNo = 'ACK' . now()->format('Y') . rand(100000, 999999);

        $applicant->update([
            'acknowledgement_no' => $ackNo,
            'submitted_at' => now(),
            'application_step' => 5,
            'status'           => 'submitted',
        ]);

        $submittedOn = $applicant->submitted
        ? Carbon::parse($applicant->submitted)->format('d-m-Y')
        : '-';


        $pdf = Pdf::loadView('pdf.acknowledgement', compact('applicant', 'submittedOn'));
        return $pdf->download('acknowledgement_'.$ackNo.'.pdf');
    }
}
