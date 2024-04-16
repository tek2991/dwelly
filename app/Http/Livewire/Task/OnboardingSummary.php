<?php

namespace App\Http\Livewire\Task;

use Livewire\Component;

class OnboardingSummary extends Component
{

    public $onboarding;

    public function mount($onboarding)
    {
        $this->onboarding = $onboarding;
    }

    public function render()
    {
        return view('livewire.task.onboarding-summary');
    }
}
