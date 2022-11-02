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
        <div class="mt-4 flex flex-row gap-3 text-center col-span-2 flex">
            <x-primary-button class="w-full flex justify-center" id="download">
                {{ __('Save QR Code') }}
            </x-primary-button>

            <x-danger-button
                class="w-full flex justify-center"
                onclick="confirm('Are you sure you want to close this QR Code?')
                || event.stopImmediatePropagation()"
                wire:click="$emit('closeModal')">
                {{ __('Close') }}
            </x-danger-button>

        </div>
    </div>
    <script type="module">
        const download = document.getElementById('download');
        const svg = document.getElementById('print').innerHTML;
        download.addEventListener('click', () => {
            const canvas = document.createElement('canvas');
            canvas.width = 500;
            canvas.height = 500;
            const ctx = canvas.getContext('2d');
            const img = new Image();
            img.src = 'data:image/svg+xml;base64,' + btoa(svg);
            img.onload = () => {
                ctx.drawImage(img, 0, 0);
                const a = document.createElement('a');
                a.download = 'qr-code.png';
                a.href = canvas.toDataURL('image/png');
                a.click();
            };
        });
    </script>
</div>
