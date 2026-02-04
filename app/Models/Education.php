<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Education extends Model
{
    use HasFactory;
    protected $table = 'educations';

    protected $fillable = [
        'applicant_id',
        'level',              
        'board_university',
        'subjects',
        'year_of_passing',
        'marks_obtained',
        'division',
        'certificate_no',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}