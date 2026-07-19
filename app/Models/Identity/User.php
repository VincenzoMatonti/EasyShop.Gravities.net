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
use App\Models\System\SystemError;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $email
 * @property bool $is_deleted
 * @property-read Collection<int, Role> $roles
 * @property-read Collection<int, CustomerProfile> $customerProfiles
 * @property-read Collection<int, Email> $emails
 * @property-read Collection<int, Phone> $phones
 * @property-read Collection<int, Address> $addresses
 * @property-read Collection<int, SystemError> $systemErrors
 * @property-read UserInfo|null $userInfo
 */
class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'is_deleted',
    ];

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

    /**
     * @return BelongsToMany<CustomerProfile, UserCustomerProfile>
     */
    public function customerProfiles(): BelongsToMany
    {
        return $this->belongsToMany(CustomerProfile::class, 'user_customer_profile')
            ->using(UserCustomerProfile::class)
            ->withPivot(['role', 'is_default'])
            ->withTimestamps();
    }

    public function attachCustomerProfile(CustomerProfile $profile, bool $isDefault = false): void
    {
        $this->customerProfiles()->attach($profile, ['role' => null, 'is_default' => $isDefault]);
    }

    /**
     * @return BelongsToMany<CustomerProfile,  $this>
     */
    public function activeCustomerProfiles(): BelongsToMany
    {
        return $this->customerProfiles()->where('customer_profiles.is_deleted', false);
    }

    /**
     * @return BelongsToMany<CustomerProfile,  $this>
     */
    public function defaultCustomerProfile(): BelongsToMany
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

    public function getActiveCustomerProfiles(): Collection
    {
        return $this->activeCustomerProfiles()->get();
    }

    public function hasDefaultCustomerProfile(): bool
    {
        return $this->defaultCustomerProfile()->exists();
    }

    public function getDefaultCustomerProfile(): ?CustomerProfile
    {
        /**
         * @return BelongsToMany<CustomerProfile, User>
         */
        return $this->defaultCustomerProfile()->first();
    }

    public function hasPersonalCustomerProfile(): bool
    {
        return $this->activeCustomerProfiles()->where('type', CustomerProfileType::personal)->exists();
    }

    /**
     * @return HasOne<UserInfo, $this>
     */
    public function userInfo(): HasOne
    {
        return $this->hasOne(UserInfo::class);
    }

    /**
     * @param array<string,mixed> $attributes
     */
    public function createUserInfo(array $attributes): UserInfo
    {
        return $this->userInfo()->create($attributes);
    }

    public function hasUserInfo(): bool
    {
        return $this->userInfo()->exists();
    }

    public function systemErrors(): HasMany
    {
        return $this->hasMany(SystemError::class);
    }

    /**
     * @return MorphMany<Email, $this>
     */
    public function emails(): MorphMany
    {
        return $this->morphMany(Email::class, 'emailable');
    }

    public function createPrimaryEmail(string $email, LabelEmail $label): Email
    {
        return $this->emails()->create(['label' => $label, 'email' => $email, 'is_primary' => true]);
    }

    /**
     * @return MorphMany<Phone, $this>
     */
    public function phones(): MorphMany
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }

    public function createPrimaryPhone(string $prefix, string $number, LabelPhone $label): Phone
    {
        return $this->phones()->create(['label' => $label, 'prefix' => $prefix, 'number' => $number, 'is_primary' => true]);
    }

    /**
     * @return MorphMany<Address, $this>
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole(IdentityRole $role): bool
    {
        return $this->roles()->where('name', $role->value)->exists();
    }

    /**
     * @param array<string> $roles
     */
    public function hasAnyRole(array $roles): bool
    {
        return $this->roles()->whereIn('name', $roles)->exists();
    }

    /**
     * @return array<string>
     */
    public function getRoles(): array
    {
        return $this->roles->map(fn(Role $role) => $role->name->value)->toArray();
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
