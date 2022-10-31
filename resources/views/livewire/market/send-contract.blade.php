<div class="py-1 sm:px-10 xl:p-12 col-span-2 sm:col-span-1">
    <h3 class="p-4 text-center text-2xl font-bold text-warm-gray-900">
        {{ __('Contract') }}
    </h3>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <x-reactive-button class="w-full mb-5">
            {{ __('Send') }}
        </x-reactive-button>
    </form>
</div>
