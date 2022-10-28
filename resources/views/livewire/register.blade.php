<div>
    <div class="mt-3 ml-5 sm:max-w-xl">
        <h3 class="text-lg font-medium text-warm-gray-900">
            {{ __('Register') }}
        </h3>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-1 gap-3 p-6 sm:p-12 z-50">
        <form wire:submit.prevent="submit">
            {{ $this->form }}
            <x-reactive-button class="w-full">
                {{ __('Register') }}
            </x-reactive-button>
        </form>
    </div>
    <div class="text-center mb-3" >
        <p class="text-sm">Forgot your password?
            <button onclick="Livewire.emit('openModal', 'forget-password')" class="text-blue-500 hover:text-blue-700">
                Reset</button>
        </p>
    </div>

</div>
