<div>
    <div class="m-6 sm:max-w-xl">
        <h3 class="text-4xl text-center font-bold tracking-tight text-gray-900 sm:text-5xl">
            Register
        </h3>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-1 gap-3 p-6 sm:p-12 mt-6 z-50">
        <form wire:submit.prevent="submit">
            {{ $this->form }}
            <x-reactive-button class="w-full">
                {{ __('Register') }}
            </x-reactive-button>
        </form>
    </div>

</div>
