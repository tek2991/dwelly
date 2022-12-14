<div>
    <div class="bg-darker-3 text-secondary flex justify-between items-center px-2 py-1">
        <h3>Book A Visit</h3>
        {{-- Cross button --}}
        <button type="button" wire:click="$emit('closeModal')" id="closeModal"
            class="text-secondary bg-transparent text-sm p-1.5 ml-auto inline-flex items-center">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
    @if ($success === false)
        <form wire:submit.prevent="submit">
            <div class="p-4">
                <h3 class="text-center text-darker-3 text-lg font-GraphikSemibold">{{ $property->building_name }},
                    {{ $property->locality->name }}</h3>
                <p class="text-center text-darker-3 font-GraphikLight">
                    {{ $property->bhk->name . ' ' . $property->getNoOfRooms('Bathroom') . 'Bath ' . $property->propertyType->name }}
                </p>
            </div>
            <div class="px-4">
                <div class="my-4">
                    <label for="name" class="font-GraphikMedium text-darker-3">Name*</label>
                    @error('name')
                        <label for="name" class="text-xs text-red-700 block">{{ $message }}</label>
                    @enderror
                    <input type="text" id="name" wire:model="name"
                        class="w-full border-2 border-secondary rounded-sm p-2 focus:ring-0 focus:border-piss-yellow">
                </div>
                <div class="my-4">
                    <label for="phone" class="font-GraphikMedium text-darker-3">Phone*</label>
                    @error('phone')
                        <label for="phone" class="text-xs text-red-700 block">{{ $message }}</label>
                    @enderror
                    <input type="tel" id="phone" wire:model="phone"
                        class="w-full border-2 border-secondary rounded-sm p-2 focus:ring-0 focus:border-piss-yellow">
                </div>
                <div class="my-4">
                    <label for="email" class="font-GraphikMedium text-darker-3">Email</label>
                    @error('email')
                        <label for="email" class="text-xs text-red-700 block">{{ $message }}</label>
                    @enderror
                    <input type="email" id="email" wire:model="email"
                        class="w-full border-2 border-secondary rounded-sm p-2 focus:ring-0 focus:border-piss-yellow">
                </div>
                <div class="my-4">
                    <label for="message" class="font-GraphikMedium text-darker-3">Message</label>
                    @error('message')
                        <label for="message" class="text-xs text-red-700 block">{{ $message }}</label>
                    @enderror
                    <textarea name="message" id="message" cols="30" rows="5" wire:model="message"
                        class="w-full border-2 border-secondary rounded-sm p-2 focus:ring-0 focus:border-piss-yellow"></textarea>
                </div>
                <div class="my-4">
                    <button type="submit"
                        class="w-full bg-piss-yellow text-darker-3  rounded-sm text-center px-4 py-2 text-lg hover:bg-darker-3 hover:text-piss-yellow ease-in-out duration-300">SUBMIT</button>
                </div>
            </div>
        </form>
    @else
        <div class="my-4">
            <img src="{{ url('resources/images/message_received.svg') }}" alt="" class="w-96">
            <p class="text-darker-2 text-lg text-center">
                Thankyou for your interest. <br> Our team will get back to you soon.
            </p>
        </div>
        <div class="p-4">
            <button type="button" wire:click="$emit('closeModal')" id="countDown"
                class="w-full bg-piss-yellow text-darker-3  rounded-sm text-center px-4 py-2 text-lg hover:bg-darker-3 hover:text-piss-yellow ease-in-out duration-300">CONTINUE 3</button>
        </div>

        <script>
            // Count down timer of 3 seconds
            let countDown = 3;
            setInterval(() => {
                // If countDown is 0 then stop the interval and close the modal
                if (countDown === 0) {
                    clearInterval();
                    document.getElementById('closeModal').click();  
                }
                countDown--;
                document.getElementById('countDown').innerHTML = `CONTINUE ${countDown}`;
            }, 1000);
        </script>
    @endif
</div>
