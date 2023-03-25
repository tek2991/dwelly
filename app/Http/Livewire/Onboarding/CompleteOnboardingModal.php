<?php

namespace App\Http\Livewire\Onboarding;

use App\Models\Onboarding;
use LivewireUI\Modal\ModalComponent;

class CompleteOnboardingModal extends ModalComponent
{
    public $property_id;
    public $onboarding;

    public $canBeCompleted;

    public function mount($property_id)
    {
        $this->property_id = $property_id;
        $this->onboarding = Onboarding::where('property_id', $property_id)->first();

        $this->canBeCompleted = $this->onboarding->canBeCompleted();
    }

    public function completeOnboarding()
    {
        $this->onboarding->completed = true;
        $this->onboarding->save();

        return redirect()->route('onboarding.show', $this->onboarding);
    }

    public function render()
    {
        return view('livewire.onboarding.complete-onboarding-modal');
    }
}
