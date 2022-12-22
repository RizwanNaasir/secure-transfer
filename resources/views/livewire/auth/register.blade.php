<div>
    <div class="mt-3 ml-5 sm:max-w-xl">
        <h3 class="text-lg font-medium text-warm-gray-900">
            {{ __('lang.register') }}
        </h3>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-1 gap-3 p-6 sm:p-12 z-50">
        <form wire:submit.prevent="submit">
            {{ $this->form }}
            <x-reactive-button class="w-full">
                {{ __('lang.register') }}
            </x-reactive-button>
        </form>
    </div>
    <div class="text-center mb-3" >
        <p class="text-sm">{{__('lang.forgot-password')}}
            <button onclick="Livewire.emit('openModal', 'auth.forget-password')" class="text-blue-500 hover:text-blue-700">
                {{__('lang.reset')}}</button>
        </p>
    </div>

</div>
