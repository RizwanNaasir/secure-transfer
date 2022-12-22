<div class="py-1 sm:px-10 xl:p-12 col-span-2 sm:col-span-1">
    <h3 class="text-lg font-medium text-warm-gray-900">
        {{ __('lang.add_new_contract') }}
    </h3>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <x-reactive-button class="w-full">
            {{__('lang.make_contract_secure_payment') }}
        </x-reactive-button>
    </form>
</div>
