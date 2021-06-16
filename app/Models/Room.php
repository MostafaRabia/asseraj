<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:j/n/Y g:i A',
    ];

    public function student()
    {
        return $this->hasOne(User::class, 'id', 'student_id');
    }

    public function teacher()
    {
        return $this->hasOne(User::class, 'id', 'teacher_id');
    }
}
