<div>
    <div class="m-6 sm:max-w-xl">
        <h3 class="text-4xl text-center font-bold tracking-tight text-gray-900 sm:text-5xl">
            Register
        </h3>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 p-6 sm:p-12 mt-6 z-50">
        <div class="h-32 md:h-auto md:w-full ">
            <img class="object-cover w-full h-full rounded-lg" src="https://source.unsplash.com/user/erondu/1600x900"
                 alt="img" />
        </div>
        <form wire:submit.prevent="submit">
            {{ $this->form }}

            <button type="submit"
                    class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                Submit
            </button>
        </form>
    </div>

</div>
