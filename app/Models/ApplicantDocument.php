<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicantDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'document_type',
        'file_path',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
