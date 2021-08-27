<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['created_at'];

    protected $casts = [
        'data' => 'array',
    ];

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->timezone(optional(auth()->user())->timezone)->format('j/n/Y g:i A');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function plan()
    {
        return $this->hasOne(Plan::class, 'id', 'plan_id');
    }
}
