<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

#[Fillable(['name', 'email', 'password','is_deleted'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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
            'is_deleted' => 'boolean',
        ];
    }

    /**
     * Scope per utenti attivi
     */
    public function scopeActive(Builder $query)
    {
        return $query->where('is_deleted', false);
    }

    public function userInfo()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }
}
