<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class RegistrationController extends Controller
{
    public function create()
    {
        return view('applicant.register');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'already_applied'        => 'required|in:0,1',
            'post'                   => 'required|string',
            'subject'                => 'required|string',
            'gender'                 => 'required|in:male,female,others',
            'physically_handicapped' => 'required|in:0,1',
            'category'               => 'required|in:general,st,sc,obc',
            'dob'                    => 'required|date',
            'name'                   => 'required|string|max:255',
            'mobile'                 => 'required|digits:10',
            'email'                  => 'required|email|unique:users,email',
            'password'               => 'required|min:6|confirmed',
        ],[
            'already_applied.required' => 'Please select if you have already applied.',
            'subject.required' => 'Please select a subject.',
            'gender.required' => 'Please select your gender.',
            'physically_handicapped.required' => 'Please select if you are physically handicapped.',
            'category.required' => 'Please select your category.',
            'dob.required' => 'Date of birth is required.',
            'name.required' => 'Full name is required.',
            'mobile.required' => 'Mobile number is required.',
            'mobile.digits' => 'Mobile number must be 10 digits.',
            'email.required' => 'Email is required.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'password.confirmed' => 'Passwords do not match.'
        ]);

        if($request->physically_handicapped == '1' && empty($request->handicapped_remark))
            {
                return back()->withErrors(['handicapped_remark' => 'Please mention your disability'])->withInput();
            }

        $dob = Carbon::parse($request->dob);
        $cutoffDate = Carbon::create(2024, 1, 1);

        $age = $dob->diffInyears($cutoffDate);

        if($age < 25 ){
            return back()->WithErrors([
                'dob' => 'Minumum Age should be 25 years on 01-01-2024'
            ])->withInput();
        }

        $maxAge = 40;

        if ($request->category === 'general') {
            if ($request->physically_handicapped == 1) {
                $maxAge = 45;
            }
        }

        if ($request->category === 'st') {
            $maxAge = 43;

            if ($request->gender === 'female') {
                $maxAge = 45;
            }
        }

        if ($request->category === 'sc') {
            $maxAge = 45;

            if ($request->gender === 'female') {
                $maxAge = 48;
            }
        }

        if ($request->category === 'obc') {
            $maxAge = 47;

            if ($request->gender === 'female') {
                $maxAge = 50;
            }
        }

        if ($age > $maxAge) {
            return back()->withErrors([
                'dob' => "Maximum age allowed is {$maxAge} years for your category"
            ])->withInput();
        }
            

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'applicant',
        ]);

        Applicant::create([
            'user_id'         => $user->id,
            'already_applied' => $request->already_applied,
            'post'            => $request->post,
            'subject'         => $request->subject,
            'category'        => $request->category,
            'gender'          => $request->gender,
            'handicapped'     => (int) $request->physically_handicapped,
            'handicapped_remark' => $request->physically_handicapped ? $request->handicap_reason : null,
            'dob'             => $request->dob,
            'mobile'          => $request->mobile,
        ]);
        Auth::login($user);
        return redirect()->route('applicant.dashboard')
            ->with('success', 'Registration successful!');
    }
}
