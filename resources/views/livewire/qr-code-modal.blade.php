<div class="h-96">
    <div class="mt-3 ml-5 sm:max-w-xl">
        <h3 class="text-lg font-medium text-warm-gray-900">
            {{ __('Generated QR Code') }}
        </h3>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 p-6 sm:p-12 z-40">
        <div class="flex justify-center h-64" id="print">
            {!!$qrCode!!}
        </div>
        <div class="mt-4 flex flex-row gap-3 text-center col-span-2 flex" >
            <x-primary-button class="w-full flex justify-center" onclick="">
                    {{ __('Save QR Code') }}
            </x-primary-button>

            <x-danger-button class="w-full flex justify-center" onclick="confirm('Are you sure you want to close this QR Code?') || event.stopImmediatePropagation()"
                             wire:click="$emit('closeModal')">
                {{ __('Close') }}
            </x-danger-button>

        </div>
    </div>
</div>
