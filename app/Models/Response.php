<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    // Allow mass assignment
    protected $fillable = ['form_id', 'response_json'];

    // Cast response_json as array
    protected $casts = [
        'response_json' => 'array',
    ];

    // Relationship: A response belongs to a Form
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}