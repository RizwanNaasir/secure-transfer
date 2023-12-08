<div class="py-10 px-6 sm:px-10 xl:p-12 col-span-2 sm:col-span-2">
    <h3 style="margin-left: 38%" class="text-lg flex justify-center  content-center font-semibold text-center text-warm-gray-900">
        {{__('lang.register')}}
    </h3>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <x-reactive-button class="w-[62%] text-center float-right ">
            {{ __('lang.register') }}
        </x-reactive-button>
    </form>
</div>
