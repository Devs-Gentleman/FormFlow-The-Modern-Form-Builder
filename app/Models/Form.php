<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'json_structure',
        'public_link',
        'status',
        'expires_at',
        'identifier_field',
    ];

    protected $casts = [
        'json_structure' => 'array',
        'expires_at' => 'datetime', // <--- Auto-convert to Carbon date object
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}