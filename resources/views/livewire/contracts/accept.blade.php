<div>
    <div class="w-96 h-96 m-auto rounded-xl relative text-white ">
        <div class="w-full px-8 absolute top-8">
            <div class="flex justify-center">
                <dl>
                    <h3 class="text-black mb-0 ml-0 font-bold text-lg">Approve Payment</h3>
                    <button
                        class="bg-pink-400 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded-sm text-xl mt-14">
                        QR code
                        <span class="ml-2">
                                <i class="fa-sharp fa-solid fa-qrcode fa-lg"></i>
                            </span>
                    </button>
                    <br>
                    <button
                        class="text-center bg-purple-500 hover:bg-purple-700 text-white font-bold pr-0 py-2 px-6 rounded-sm text-xl mt-10">
                        Photo
                        <span class="ml-2">
                                <i class="fa-sharp fa-solid fa-image fa-lg"></i>
                        </span>
                    </button>
                </dl>

            </div>
            <div class="pt-1 flex justify-around">
                <button onclick="Livewire.emit('openModal','contracts.payment-approved')"
                    class="bg-green-500 hover:bg-green-700  text-white font-bold py-2 px-8 rounded-sm text-xl mt-14">
                    Ok
                </button>
                <button  wire:click="$emit('closeModal')" class="bg-red-500 hover:bg-red-700  text-white font-bold py-2 px-4 rounded-sm text-xl mt-14">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
