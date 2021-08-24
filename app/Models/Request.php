<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    public $guarded = [];

    protected $appends = ['created_at'];

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->timezone(optional(auth()->user())->timezone)->format('j/n/Y g:i A');
    }

    public function student()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
