<?php

namespace App\Models;

use Carbon\Carbon;
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

    protected $appends = ['created_at'];

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->timezone(optional(auth()->user())->timezone)->format('j/n/Y g:i A');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'model')->with(['user:first_name,last_name,image,id']);
    }
}
