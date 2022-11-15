<form wire:submit.prevent="submit">
    <div class="grid grid-cols-4 md:grid-cols-4 sm:grid-cols-4 gap-0 py-0 ">
{{--        <div class="col-span-2 md:col-span-4 p-12 pt-4">--}}
{{--            <h3 class="text-center mb-2 mr-6"><strong>Scan QR code</strong></h3>--}}
{{--            <div class="box-border h-36 w-44 pt-0 p-0 border-2">--}}
{{--                <img src="{{ asset('assets/images/img.png') }}" alt="">--}}
{{--            </div>--}}
        </div>
        <div class="col-span-4 p-12 pt-4">
            <h3 class="text-center mb-2 mr-6"><strong>Select a Photo</strong></h3>

            <div class="w-full" id="wrapper">
                <label for="dropzone-file"
                       class=" w-44 h-44 bg-gray-50 rounded-lg  cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col justify-center items-center p-4">
                        <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <p class="mb-2 text-center text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span>
                            or drag and drop</p>
                    </div>
                    <input id="dropzone-file" type="file" class="hidden"/>

                </label>
            </div>
        </div>
    </div>


{{--button grid--}}

    <div class="grid grid-cols-2 md:grid-cols-4 sm:grid-cols-2 gap-0 py-0">
        <div class="flex justify-center ml-4 mb-5 col-span-4 md:col-span-4  inline-flex gap-6  rounded-md shadow-sm"
             role="group">
            <button type="submit"
                    class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-8 py-2.5 text-center mr-2 mb-2">
                <span class="ml-2">OK </span>
            </button>
            <button type="button" onclick="Livewire.emit('closeModal', 'contracts.decline')"
                    class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                <span class="ml-2">Cancel</span>
            </button>
        </div>
    </div>
</form>



