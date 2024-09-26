<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionData extends Model
{
    use HasFactory;
    protected $fillable = [
        'submission_id',
        'form_field_id',
        'field_value',
    ];
    public function formTemplate()
    {
        return $this->belongsTo(FormTemplate::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function submissionData()
    {
        return $this->hasMany(SubmissionData::class);
    }
}
