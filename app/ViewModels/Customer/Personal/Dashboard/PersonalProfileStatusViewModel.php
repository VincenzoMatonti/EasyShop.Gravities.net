<?php

namespace App\ViewModels\Customer\Personal\Dashboard;

use App\Enum\Customer\PersonalProfileBadgeType;

class PersonalProfileStatusViewModel
{
    public function __construct(
        public readonly array $checks,
    ) {}


    public function items(): array
    {
        return array_map(function (array $check) {

            return [
                'label' => $check['label'],
                'badge' => [
                    'label' => $this->badgeLabel($check),
                    'type' => $this->badgeType($check),
                ],
            ];
        }, $this->checks);
    }
    
    public function completedCount(): int
    {
        return \count(array_filter($this->checks, fn(array $check) => $check['completed']));
    }


    public function totalCount(): int
    {
        return \count($this->checks);
    }

    public function badgeType(array $check): PersonalProfileBadgeType
    {
        return $check['completed'] ? PersonalProfileBadgeType::Success : PersonalProfileBadgeType::Warning;
    }


    public function badgeLabel(array $check): string
    {
        return $check['completed'] ? 'Completato' : 'Da completare';
    }

    public function progressLabel(): string
    {
        return $this->completionPercentage() . '% completato';
    }

    public function completionPercentage(): int
    {
        if ($this->totalCount() === 0) {
            return 0;
        }

        return (int) round(($this->completedCount() / $this->totalCount()) * 100);
    }


    public function isComplete(): bool
    {
        return $this->completionPercentage() === 100;
    }


    public function statusLabel(): string
    {
        return $this->isComplete() ? 'Profilo completo' : 'Profilo incompleto';
    }


    public function statusDescription(): string
    {
        return $this->isComplete() ? 'Il tuo profilo personale è completo.' : 'Completa i dati mancanti per attivare il tuo profilo.';
    }


    public function checks(): array
    {
        return $this->checks;
    }
}
