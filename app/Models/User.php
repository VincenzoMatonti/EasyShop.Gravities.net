<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Customer\Address;
use App\Models\Customer\Company;
use App\Models\Customer\CustomerProfile;
use App\Models\Customer\Email;
use App\Models\Customer\Phone;
use App\Models\Customer\Role;
use App\Models\Customer\UserCustomerProfile;
use App\Models\Customer\UserInfo;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;


class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'is_deleted'
    ];

    protected $hidden = [
        'password',
        'remember_token'
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
            'is_deleted' => 'boolean',
        ];
    }

    /**
     * Scope per utenti attivi
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_deleted', false);
    }

    public function userInfo()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function customerProfiles()
    {
        return $this->belongsToMany(CustomerProfile::class)
                    ->using(UserCustomerProfile::class)
                    ->withPivot(['role', 'is_default'])
                    ->withTimestamps();
    }

    public function defaultCustomerProfile()
    {
        return $this->belongsToMany(CustomerProfile::class)
                    ->wherePivot('is_default', true)
                    ->withPivot('role', 'is_default')
                    ->withTimestamps();
    }

    public function emails()
    {
        return $this->morphMany(Email::class, 'emailable');
    }

    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    private function hasRole(string $role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function hasAnyRole(array $roles): bool
    {
        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }

        return false;
    }

    public function getRoles(): array
    {
        return $this->roles->pluck('name')->toArray();
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isManager(): bool
    {
        return $this->hasRole('manager');
    }

    public function isCustomer(): bool
    {
        return $this->hasRole('customer');
    }
}
