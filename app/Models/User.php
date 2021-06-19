<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use App\Traits\EmailSigTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasFactory;
    use Notifiable;
    use HasApiTokens;
    use EmailSigTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'emailsig',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'reads_save' => 'array',
        'reads_learning' => 'array',
    ];

    protected $appends = [
        'full_name',
    ];

    public function sendPasswordResetNotification($token)
    {
        $url = config('app.front_url').'/reset/password?token='.$token;

        $this->notify(new ResetPasswordNotification($url));
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
