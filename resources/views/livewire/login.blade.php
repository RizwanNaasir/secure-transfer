<div>
    <div class="m-6 sm:max-w-xl">
        <h3 class="text-4xl my-8 text-center font-bold tracking-tight text-gray-900 sm:text-5xl">
            Login
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
                {{ __('Login') }}
            </x-reactive-button>
        </form>
        <div class="mt-4 text-center">
            <p class="text-sm">Don't have an account yet?
                <button onclick="Livewire.emit('openModal', 'forgot-password')" class="text-blue-500 hover:text-blue-700">
                    Sign up.</button>
            </p>
        </div>
    </div>
</div>
