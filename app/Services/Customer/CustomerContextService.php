<?php

namespace App\Services\Customer;

use App\Models\Customer\CustomerProfile;
use App\Models\Identity\User;
use Illuminate\Support\Facades\Session;

class CustomerContextService
{
    private const SESSION_KEY = 'customer_profile_id';

    /**
     * Verifica se esiste un CustomerProfile attivo e valido in sessione.
     */
    public function has(User $user): bool
    {
        $customerProfileId = $this->currentId();
        
        return $customerProfileId !== null && $user->hasCustomerProfile($customerProfileId);
    }

    /**
     * Restituisce l'id del CustomerProfile attivo.
     */
    public function currentId(): ?int
    {
        return Session::get(self::SESSION_KEY);
    }

    /**
     * Restituisce il CustomerProfile attivo.
     */
    public function current(): ?CustomerProfile
    {
        $customerProfileId = $this->currentId();

        if ($customerProfileId === null) {
            return null;
        }

        return CustomerProfile::query()->find($customerProfileId);
    }

    /**
     * Attiva un CustomerProfile.
     */
    public function set(CustomerProfile $customerProfile): void
    {
        Session::put(self::SESSION_KEY, $customerProfile->id);
    }

    /**
     * Attiva un CustomerProfile tramite id.
     */
    public function setById(int $customerProfileId): void
    {
        Session::put(self::SESSION_KEY, $customerProfileId);
    }

    /**
     * Rimuove il CustomerProfile attivo.
     */
    public function clear(): void
    {
        Session::forget(self::SESSION_KEY);
    }

    /**
     * Attiva automaticamente il profilo di default dell'utente.
     */
    public function setDefault(User $user): bool
    {
        $defaultProfile = $user->getDefaultCustomerProfile();

        if ($defaultProfile === null) {
            return false;
        }

        $this->set($defaultProfile);

        return true;
    }
}
