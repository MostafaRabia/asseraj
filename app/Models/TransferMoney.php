<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferMoney extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:j/n/Y g:i A',
        'done_date' => 'datetime:j/n/Y',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
