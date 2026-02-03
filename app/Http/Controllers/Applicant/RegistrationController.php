<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
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
        ]);

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
