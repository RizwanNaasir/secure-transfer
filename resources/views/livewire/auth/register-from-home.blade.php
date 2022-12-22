<div class="py-10 px-6 sm:px-10 xl:p-12 col-span-2 sm:col-span-1">
    <h3 class="text-lg font-medium text-warm-gray-900">
        {{__('lang.register')}}
    </h3>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <x-reactive-button class="w-full">
            {{ __('lang.register') }}
        </x-reactive-button>
    </form>
</div>
