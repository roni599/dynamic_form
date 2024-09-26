<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;
    protected $fillable = [
        'form_template_id',
        'field_label',
        'field_type',
        'field_options',
        'is_required',
        'file_path',
    ];
    public function formTemplate()
    {
        return $this->belongsTo(FormTemplate::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function submissionData()
    {
        return $this->hasMany(SubmissionData::class);
    }
}
