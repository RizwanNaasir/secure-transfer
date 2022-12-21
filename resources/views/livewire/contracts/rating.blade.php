<div>
    <div class="mt-3 ml-5">
        <h3 class="text-lg font-medium text-warm-gray-900">
            {{ __('Rate This User') }}
        </h3>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 p-6 sm:p-12 z-40">

        <form wire:submit.prevent="star">
            {{ $this->form }}
            <x-reactive-button class="w-full">
                {{ __('Rate') }}
            </x-reactive-button>
        </form>
    </div>
</div>
