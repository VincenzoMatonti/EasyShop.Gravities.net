<?php

namespace App\Jobs\Customer\Personal;

use App\Models\Customer\CustomerProfile;
use App\Models\Identity\User;
use App\Services\Mail\Customer\Personal\PersonalProfileMailService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendPersonalProfileCreatedMailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public readonly int $profileId, public readonly int $userId) {}

    /**
     * Execute the job.
     */
    public function handle(PersonalProfileMailService $mailService): void
    {
        $profile = CustomerProfile::findOrFail($this->profileId);

        $user = User::findOrFail($this->userId);

        $mailService->sendProfileCreated(user: $user, profile: $profile);
    }
}
