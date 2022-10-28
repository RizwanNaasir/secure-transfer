<div>
    <div class="mt-3 ml-5 sm:max-w-xl">
        <h3 class="text-lg font-medium text-warm-gray-900">
            {{ __('Change Password ?') }}
        </h3>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-6 sm:p-12 z-40">
        <div class="h-32 md:h-auto md:w-full ">
            <img class="object-cover w-full h-full rounded-lg" src="https://source.unsplash.com/user/erondu/1600x900"
                 alt="img"/>
        </div>
        <form wire:submit.prevent="submit">
            {{ $this->form }}
            <x-reactive-button class="w-full">
                {{ __('Change Password') }}
            </x-reactive-button>
        </form>
        <div class="mt-4 text-center col-span-2 flex" >
            <p class="text-sm">Forgot your password?
                <button onclick="Livewire.emit('openModal', 'forget-password')" class="text-blue-500 hover:text-blue-700">
                    Reset</button>
            </p>
        </div>
    </div>
</div>

