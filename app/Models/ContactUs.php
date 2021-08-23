<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'email' => 'encrypted',
        'is_showed' => 'boolean',
        'data' => 'array',
    ];

    public function comments()
    {
        return $this->morphMany(Comment::class, 'model')->with(['user:first_name,last_name,image,id']);
    }
}
