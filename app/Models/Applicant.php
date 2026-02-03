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
        'post',
        'subject',
        'category',
        'gender',
        'handicapped',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
