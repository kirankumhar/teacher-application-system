<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicant;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ApplicantController extends Controller
{
    public function index()
    {
        $applicants = Applicant::with('user')->latest()->get();
        return view('admin.applicants.index', compact('applicants'));
    }

    public function submitted()
    {
        $applications = Applicant::with('user')
            ->where('status', 'submitted')
            ->orderBy('submitted_at', 'desc')
            ->get();

        return view('admin.applicants.submitted', compact('applications'));
    }

    public function show(Applicant $applicant)
    {
        $applicant->load([
            'user',
            'educations',
            'documents',
            'payments',
        ]);

        return view('admin.applicants.show', compact('applicant'));
    }

    public function approved()
    {
        $applications = Applicant::with('user')
            ->where('status', 'approved')
            ->orderBy('approved_at', 'desc')
            ->get();

        return view('admin.applicants.approved', compact('applications'));
    }

    public function approve(Applicant $applicant)
    {
        if ($applicant->status !== 'submitted') {
            return back()->with('warning', 'Application already processed.');
        }

        $registrationNo = $this->generateRegistrationNo($applicant->subject);

        $applicant->update([
            'status'          => 'approved',
            'registration_no' => $registrationNo,
            'approved_at'     => now(),
        ]);

        return redirect()
            ->route('admin.applicants.approved')
            ->with('success', 'Application approved successfully.');
    }

    private function generateRegistrationNo(string $subject): string
    {
        $map = [
            'English'     => 'TENG',
            'Maths'       => 'TMTS',
            'Hindi'       => 'THIN',
            'Agriculture' => 'TAGR',
        ];

        return 'CED/'.$map[$subject].'/2024/'.rand(100000, 999999);
    }

    public function reject(Applicant $applicant)
    {
        if ($applicant->status !== 'submitted') {
            return back()->with('warning', 'Application already processed.');
        }

        $applicant->update([
            'status' => 'rejected',
        ]);

        return redirect()
            ->route('admin.applicants.submitted')
            ->with('error', 'Application rejected.');
    }
}
