<?php

namespace App\Models\Identity;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enum\Customer\CustomerProfileType;
use App\Enum\Customer\LabelEmail;
use App\Enum\Customer\LabelPhone;
use App\Enum\Identity\IdentityRole;
use App\Models\Customer\Address;
use App\Models\Customer\CustomerProfile;
use App\Models\Customer\Email;
use App\Models\Customer\Phone;
use App\Models\Customer\UserCustomerProfile;
use App\Models\Customer\UserInfo;
use App\Models\Identity\Role;
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

    public function customerProfiles()
    {
        return $this->belongsToMany(CustomerProfile::class, 'user_customer_profile')
            ->using(UserCustomerProfile::class)
            ->withPivot(['role', 'is_default'])
            ->withTimestamps();
    }

    public function attachCustomerProfile(CustomerProfile $profile, bool $isDefault = false,): void
    {
        $this->customerProfiles()->attach($profile, ['role' => null, 'is_default' => $isDefault,]);
    }

    public function activeCustomerProfiles()
    {
        return $this->customerProfiles()->where('customer_profiles.is_deleted', false);
    }

    public function defaultCustomerProfile()
    {
        return $this->activeCustomerProfiles()->wherePivot('is_default', true);
    }

    public function hasCustomerProfile(int $customerProfileId): bool
    {
        return $this->activeCustomerProfiles()->whereKey($customerProfileId)->exists();
    }

    public function hasActiveCustomerProfiles(): bool
    {
        return $this->activeCustomerProfiles()->exists();
    }

    public function getActiveCustomerProfiles()
    {
        return $this->activeCustomerProfiles()->get();
    }

    public function hasDefaultCustomerProfile(): bool
    {
        return $this->defaultCustomerProfile()->exists();
    }

    public function getDefaultCustomerProfile(): ?CustomerProfile
    {
        return $this->defaultCustomerProfile()->first();
    }

    public function hasPersonalCustomerProfile(): bool
    {
        return $this->activeCustomerProfiles()->where('type', CustomerProfileType::personal)->exists();
    }

    public function userInfo()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function createUserInfo(array $attributes): UserInfo
    {
        return $this->userInfo()->create($attributes);
    }

    public function hasUserInfo(): bool
    {
        return $this->userInfo()->exists();
    }

    public function emails()
    {
        return $this->morphMany(Email::class, 'emailable');
    }

    public function createPrimaryEmail(string $email, LabelEmail $label,): Email
    {
        return $this->emails()->create(['label' => $label, 'email' => $email, 'is_primary' => true,]);
    }

    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }

    public function createPrimaryPhone(string $prefix, string $number, LabelPhone $label,): ?Phone
    {
        return $this->phones()->create(['label' => $label, 'prefix' => $prefix, 'number' => $number, 'is_primary' => true,]);
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole(IdentityRole $role): bool
    {
        return $this->roles()->where('name', $role->value)->exists();
    }

    public function hasAnyRole(array $roles): bool
    {
        return $this->roles()->whereIn('name', $roles)->exists();
    }

    public function getRoles(): array
    {
        return $this->roles->pluck('name')->map(fn(IdentityRole $role) => $role->value)->toArray();
    }

    public function isAdmin(): bool
    {
        return $this->hasRole(IdentityRole::ADMIN);
    }

    public function isManager(): bool
    {
        return $this->hasRole(IdentityRole::MANAGER);
    }

    public function isCustomer(): bool
    {
        return $this->hasRole(IdentityRole::CUSTOMER);
    }

    public function homeRoute(): string
    {
        return match (true) {

            $this->isAdmin() => 'admin.index',

            $this->isManager() => 'manager.index',

            $this->isCustomer() => 'customer.index',

            default => 'home.index',
        };
    }
}
