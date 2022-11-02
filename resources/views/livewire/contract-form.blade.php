@php use App\Models\User; @endphp
<div class="py-1 sm:px-10 xl:p-12 col-span-2 sm:col-span-1">
    <h3 class="text-lg font-medium text-warm-gray-900">
        {{ __('Add New Contract') }}
    </h3>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <x-reactive-button class="w-full">
            {{ __('Add new contract to make your payment secure') }}
        </x-reactive-button>
    </form>
</div>
