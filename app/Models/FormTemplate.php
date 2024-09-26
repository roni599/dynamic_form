<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormTemplate extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'status',
        'assigne_by',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function formFields()
    {
        return $this->hasMany(FormField::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
