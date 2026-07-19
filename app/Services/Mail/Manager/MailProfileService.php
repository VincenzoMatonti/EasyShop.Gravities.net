<?php

namespace App\Services\Mail\Manager;

use App\Enum\Mail\MailProfile;
use Illuminate\Mail\Mailables\Address;

class MailProfileService
{
    /**
     * @return array{address:string, name:string}
     */
    private function profile(MailProfile $profile): array
    {
        /** @var array{address:string, name:string} $config */
        $config = config("mail.profiles.{$profile->value}");

        return $config;
    }

    private function address(MailProfile $profile): Address
    {
        $config = $this->profile($profile);

        return new Address($config['address'], $config['name']);
    }

    public function default(): Address
    {
        return $this->address(MailProfile::DEFAULT);
    }

    public function support(): Address
    {
        return $this->address(MailProfile::SUPPORT);
    }

    public function marketing(): Address
    {
        return $this->address(MailProfile::MARKETING);
    }

    public function orders(): Address
    {
        return $this->address(MailProfile::ORDERS);
    }

    public function billing(): Address
    {
        return $this->address(MailProfile::BILLING);
    }
}
