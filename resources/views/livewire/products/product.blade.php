<form wire:submit.prevent="submit">
    <div class="space-y-4 divide-y divide-gray-200 sm:space-y-5">
        <div class="space-y-2 sm:space-y-5">
            <div>
                <h3 class="text-lg font-medium leading-6 text-gray-900">Product</h3>
{{--                <p class="mt-1 max-w-2xl text-sm text-gray-500">--}}
{{--                    This information will be displayed publicly so be--}}
{{--                    careful what you share.</p>--}}
            </div>
            <div class="space-y-6 sm:space-y-5">
                {{$this->form}}
            </div>
        </div>
    </div>
    <div class="pt-5">
        <div class="flex justify-end">
            <x-reactive-button>
                Save Product
            </x-reactive-button>
        </div>
    </div>
</form>
