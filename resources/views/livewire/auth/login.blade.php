<div>
    <div class="mt-3 ml-5 sm:max-w-xl">
        <h3 class="text-lg font-medium text-warm-gray-900">
            {{ __('Login') }}
        </h3>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 p-6 sm:p-12 z-40">
        <form wire:submit.prevent="submit">
            {{ $this->form }}
            <x-reactive-button class="w-full">
                {{ __('Login') }}
            </x-reactive-button>
        </form>
        <div class="mt-4 text-center col-span-2 flex gap-3" >
            <p class="text-sm">Don't have an account yet?
                <button onclick="Livewire.emit('openModal', 'auth.register')" class="text-blue-500 hover:text-blue-700">
                    Sign up.</button>
            </p>
            <p class="text-sm">Forgot your password?
                <button onclick="Livewire.emit('openModal', 'auth.forget-password')" class="text-blue-500 hover:text-blue-700">
                    Reset</button>
            </p>
        </div>
    </div>
</div>
