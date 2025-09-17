<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Immigration extends Model
{
    protected $fillable = [
        'created_by','assigned_to',
        'applicant_name','passport_number','visa_type','country',
        'application_date','expiry_date','status','notes',
        'document_one','document_two',

        // new header + uploads
        'application_number','lead_source','lead_source_other','resume_path',

        // JSON sections
        'personal_info','passport_info','relative_info','family_info',
        'spouse_info','education_info','job_history','property_info',
        'finance_info','travel_info',
    ];

    protected $casts = [
        'application_date' => 'date',
        'expiry_date'      => 'date',
        'personal_info'    => 'array',
        'passport_info'    => 'array',
        'relative_info'    => 'array',
        'family_info'      => 'array',
        'spouse_info'      => 'array',
        'education_info'   => 'array',
        'job_history'      => 'array',
        'property_info'    => 'array',
        'finance_info'     => 'array',
        'travel_info'      => 'array',
    ];

    public function creator()  { return $this->belongsTo(\App\Models\User::class, 'created_by'); }
    public function assignee() { return $this->belongsTo(\App\Models\User::class, 'assigned_to'); }
}
