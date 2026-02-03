<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationPayment extends Model
{
    protected $fillable = [
        'applicant_id',
        'bank_name',
        'amount',
        'payment_ref',
        'payment_date',
        'receipt',
        'status',
    ];
}
