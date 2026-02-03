<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicant extends Model
{
    //
    use HasFactory;

    protected $fillable = [
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
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
