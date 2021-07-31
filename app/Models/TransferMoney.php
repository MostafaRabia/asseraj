<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class TransferMoney extends Model
{
    use HasFactory;

    protected $appends = ['created_at','done_date'];

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->timezone(optional(auth()->user())->timezone)->format('j/n/Y g:i A');
    }

    public function getDoneDateAttribute()
    {
        return Carbon::parse($this->attributes['done_date'])->timezone(optional(auth()->user())->timezone)->format('j/n/Y');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
