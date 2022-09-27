<form wire:submit.prevent="submit">
    @if ($success === false)
        <h2 class="font-GraphikSemibold text-darker-3 text-3xl">Have queries?</h2>
        <p class="text-darker-2 text-lg">
            Drop your details and we will get back to you.
        </p>
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
            <div class="my-4">
                <button type="submit"
                    class="w-full bg-piss-yellow text-darker-3  rounded-sm text-center p-4 text-lg hover:bg-darker-3 hover:text-piss-yellow ease-in-out duration-300">SUBMIT</button>
            </div>
        </div>
    @else
        <div class="my-4">
            <img src="{{ url('resources/images/message_received.svg') }}" alt="" class="w-96">
            <p class="text-darker-2 text-lg text-center">
                We got your message. <br> Our team will get back to you soon.
            </p>
        </div>
    @endif
</form>
