<div>
    <div class="bg-darker-3 text-secondary flex justify-between items-center px-2 py-1">
        <h3 class="capitalize">Rent Out With Dwelly</h3>
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
            <div class="px-4 mt-4 grid grid-cols-2 gap-4">
                <div class="">
                    <label for="name" class="font-GraphikMedium text-darker-3">Name*</label>
                    @error('name')
                        <label for="name" class="text-xs text-red-700 block">{{ $message }}</label>
                    @enderror
                    <input type="text" id="name" wire:model="name"
                        class="w-full border-2 border-secondary rounded-sm p-2 focus:ring-0 focus:border-piss-yellow">
                </div>
                <div class="">
                    <label for="phone" class="font-GraphikMedium text-darker-3">Phone*</label>
                    @error('phone')
                        <label for="phone" class="text-xs text-red-700 block">{{ $message }}</label>
                    @enderror
                    <input type="tel" id="phone" wire:model="phone"
                        class="w-full border-2 border-secondary rounded-sm p-2 focus:ring-0 focus:border-piss-yellow">
                </div>
                <div class="">
                    <label for="email" class="font-GraphikMedium text-darker-3">Email</label>
                    @error('email')
                        <label for="email" class="text-xs text-red-700 block">{{ $message }}</label>
                    @enderror
                    <input type="email" id="email" wire:model="email"
                        class="w-full border-2 border-secondary rounded-sm p-2 focus:ring-0 focus:border-piss-yellow">
                </div>
            </div>
            <div class="p-4">
                <label for="num_of_properties" class="font-GraphikMedium text-darker-3">No. of property</label>
                <x-input-select id="num_of_properties" wire:model="num_of_properties" class="w-14">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </x-input-select>
            </div>
            {{ print_r($property_type) }}
            <div class="">
                @for ($i = 0; $i < $num_of_properties; $i++)
                    <h3 class="text-darker-3 font-GraphikMedium text-lg px-4 pb-2 pt-10">Property {{ $i + 1 }}
                    </h3>
                    <div class="px-4 mt-4 grid grid-cols-2 gap-4">
                        <div class="">
                            <label for="property_type_{{ $i }}"
                                class="font-GraphikMedium text-darker-3">Property Type*</label>
                            @error('property_type.' . $i)
                                <label for="property_type_{{ $i }}"
                                    class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror
                            <select id="property_type_{{ $i }}"
                                wire:model="property_type.{{ $i }}">
                                @foreach ($property_types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                            <label for="availability_{{ $i }}"
                                class="font-GraphikMedium text-darker-3">Vacancy*</label>
                            @error('availability.' . $i)
                                <label for="availability_{{ $i }}"
                                    class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror
                            <x-input-select id="availability_{{ $i }}"
                                wire:model="availability.{{ $i }}">
                                <option value="1">Vacant</option>
                                <option value="0">Occupied</option>
                            </x-input-select>
                        </div>
                        {{-- Bedroom --}}
                        <div class="">
                            <label for="bedroom_{{ $i }}"
                                class="font-GraphikMedium text-darker-3">Bedrooms*</label>
                            @error('bedroom.' . $i)
                                <label for="bedroom_{{ $i }}"
                                    class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror
                            <x-input-select id="bedroom_{{ $i }}" wire:model="bedroom.{{ $i }}">
                                @for ($j = 1; $j <= 5; $j++)
                                    <option value="{{ $j }}">{{ $j }}</option>
                                @endfor
                            </x-input-select>
                        </div>
                        {{-- Bathroom --}}
                        <div class="">
                            <label for="bathroom_{{ $i }}"
                                class="font-GraphikMedium text-darker-3">Bathrooms*</label>
                            @error('bathroom.' . $i)
                                <label for="bathroom_{{ $i }}"
                                    class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror
                            <x-input-select id="bathroom_{{ $i }}"
                                wire:model="bathroom.{{ $i }}">
                                @for ($j = 1; $j <= 5; $j++)
                                    <option value="{{ $j }}">{{ $j }}</option>
                                @endfor
                            </x-input-select>
                        </div>
                        <div class="col-span-2">
                            <label for="building_name_{{ $i }}"
                                class="font-GraphikMedium text-darker-3">Society Name*</label>
                            @error('building_name.' . $i)
                                <label for="building_name_{{ $i }}"
                                    class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror
                            <input type="text" id="building_name_{{ $i }}"
                                wire:model="building_name.{{ $i }}"
                                class="w-full border-2 border-secondary rounded-sm p-2 focus:ring-0 focus:border-piss-yellow">
                        </div>
                        {{-- Address --}}
                        <div class="col-span-2">
                            <label for="address_{{ $i }}"
                                class="font-GraphikMedium text-darker-3">Address*</label>
                            @error('address.' . $i)
                                <label for="address_{{ $i }}"
                                    class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror
                            <input type="text" id="address_{{ $i }}"
                                wire:model="address.{{ $i }}"
                                class="w-full border-2 border-secondary rounded-sm p-2 focus:ring-0 focus:border-piss-yellow">
                        </div>
                    </div>
                @endfor
            </div>
            <div class="my-4 mx-4">
                <button type="submit"
                    class="w-full bg-piss-yellow text-darker-3  rounded-sm text-center px-4 py-2 text-lg hover:bg-darker-3 hover:text-piss-yellow ease-in-out duration-300">SUBMIT</button>
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
                class="w-full bg-piss-yellow text-darker-3  rounded-sm text-center px-4 py-2 text-lg hover:bg-darker-3 hover:text-piss-yellow ease-in-out duration-300">CONTINUE
                3</button>
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
