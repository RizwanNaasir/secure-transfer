<div class="py-10 px-6 sm:px-10 xl:p-12 col-span-2 sm:col-span-2">
    <h3 class="text-lg ml-56 font-semibold text-center font-medium text-warm-gray-900">
        {{__('lang.register')}}
    </h3>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <x-reactive-button style="margin-left: 35%" class="flex justify-end mx-auto justify-content-end" class="w-2/3">
            {{ __('lang.register') }}
        </x-reactive-button>
    </form>
</div>
