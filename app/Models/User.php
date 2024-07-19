<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function notifies()
    {
        return $this->belongsToMany(Notify::class)
            ->withPivot('read_at')
            ->withTimestamps();
    }

    public function unreadNotifications()
    {
        return $this->belongsToMany(Notify::class)
            ->withPivot('read_at')
            ->wherePivotNull('read_at')
            ->withTimestamps();
    }

    public function getReferralLinkAttribute()
    {
        return route('register') . '?ref=' . $this->referral_code;
    }

    protected $casts = [
        'read_at' => 'datetime',
    ];


}
