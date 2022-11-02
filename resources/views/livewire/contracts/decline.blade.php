<form wire:submit.prevent="submit">
    <div class="w-96 h-96 m-auto rounded-xl relative text-white ">
        <div class="w-full px-8 absolute top-8">
            <h3 class="text-center text-black mb-4 ml-0 font-bold text-2xl">
                Reason
            </h3>
                <div class="max-w-full md:w-full sm:w-full p-6 text-black">
                    {{$this->form}}
                </div>
            <div class=" gap-6 flex flex-row justify-center rounded-md shadow-sm sm:col-span-2 mt-10" role="group">
                <button type="submit"
                        class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    <span class="ml-2">OK </span>
                </button>
                <button type="button"  onclick="Livewire.emit('closeModal')"  class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    <span class="ml-2">Cancel</span>
                </button>
            </div>
        </div>
    </div>
</form>
