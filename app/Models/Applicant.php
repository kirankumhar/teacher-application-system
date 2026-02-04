<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        // Step-1 / basic
        'user_id',
        'already_applied',
        'post',
        'subject',
        'category',
        'gender',
        'handicapped',
        'handicapped_remark',
        'dob',
        'mobile',

        // Step-2 personal
        'address',
        'aadhaar_pan_type',
        'aadhaar_pan_no',

        // flow control
        'application_step',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function educations()
    {
        return $this->hasMany(Education::class);
    }
    public function documents()
    {
        return $this->hasMany(ApplicantDocument::class);
    }
}
