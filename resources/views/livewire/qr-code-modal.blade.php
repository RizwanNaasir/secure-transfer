<div class="h-96">
    <div class="mt-3 ml-5 sm:max-w-xl">
        <h3 class="text-lg font-medium text-warm-gray-900">
            {{ __('Generated QR Code') }}
        </h3>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 p-6 sm:p-12 z-40">
        <div class="h-32 md:h-auto md:w-full my-class" id="print">
            {!!$qrCode!!}
        </div>
        <div class="mt-4 text-center col-span-2 flex" >
            <x-primary-button class="w-full" onclick="function printDiv(id) {
                 const divContents = document.getElementById(id).innerHTML;
                const a = window.open('', '', 'height=500, width=500');
                a.document.write('<html>');
                a.document.write('<body > <h1>Save as PDF</h1>');
                    a.document.write(divContents);
                    a.document.write('</body></html>');
                a.document.close();
                a.print();
            }
            printDiv('print')">
                    {{ __('Save QR Code') }}
            </x-primary-button>
        </div>
    </div>
</div>
