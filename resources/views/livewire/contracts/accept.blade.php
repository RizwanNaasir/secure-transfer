{{--<div>--}}
{{--    <div class="w-96 h-96 m-auto rounded-xl relative text-white ">--}}
{{--        <div class="w-full px-8 absolute top-8">--}}
{{--            <div class="flex justify-center">--}}
{{--                <dl>--}}
{{--                    <h3 class="text-black mb-0 ml-0 font-bold text-lg">Approve Payment</h3>--}}
{{--                    <button--}}
{{--                        class="bg-pink-400 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded-sm text-xl mt-14">--}}
{{--                        QR code--}}
{{--                        <span class="ml-2">--}}
{{--                                <i class="fa-sharp fa-solid fa-qrcode fa-lg"></i>--}}
{{--                            </span>--}}
{{--                    </button>--}}
{{--                    <br>--}}
{{--                    <button--}}
{{--                        class="text-center bg-purple-500 hover:bg-purple-700 text-white font-bold pr-0 py-2 px-6 rounded-sm text-xl mt-10">--}}
{{--                        Photo--}}
{{--                        <span class="ml-2">--}}
{{--                                <i class="fa-sharp fa-solid fa-image fa-lg"></i>--}}
{{--                        </span>--}}
{{--                    </button>--}}
{{--                </dl>--}}

{{--            </div>--}}
{{--            <div class="pt-1 flex justify-around">--}}
{{--                <button onclick="Livewire.emit('openModal','contracts.payment-approved')"--}}
{{--                    class="bg-green-500 hover:bg-green-700  text-white font-bold py-2 px-8 rounded-sm text-xl mt-14">--}}
{{--                    Ok--}}
{{--                </button>--}}
{{--                <button  wire:click="$emit('closeModal')" class="bg-red-500 hover:bg-red-700  text-white font-bold py-2 px-4 rounded-sm text-xl mt-14">--}}
{{--                    Cancel--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="grid grid-cols-2 md:grid-cols-4 sm:grid-cols-2 gap-0 py-0">
    <div class="col-span-2 md:col-span-4 p-12 pt-4 border-r-2">
        <h3 class="text-center mb-2 mr-6"><strong>Scan QR code</strong></h3>
       <div class="box-border h-36 w-44 pt-0 p-0 border-2">
           <img  src="{{ asset('assets/images/img.png') }}" alt="">
       </div>
    </div>
    <div class="col-span-2 col-span-2 p-12 pt-4">
        <h3 class="text-center mb-2 mr-6"><strong>Select a Photo</strong></h3>

        <div class="flex  items-center w-full" id="wrapper">
            <label for="dropzone-file" class="flex flex-col justify-center items-center w-44 h-44 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col justify-center items-center p-4">
                    <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    <p class="mb-2 text-center text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                </div>
                <input id="dropzone-file" type="file" class="hidden"/>

            </label>
        </div>
    </div>
</div>

