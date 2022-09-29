<div>
    <div>
        <h3>Book A Visit</h3>
        {{-- Cross button --}}
        <button type="button" wire:click="$emit('closeModal')"
            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
    <div class="">
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
    </div>
    <div>

    </div>
</div>
