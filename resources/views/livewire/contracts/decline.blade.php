<div>
    <div class="w-96 h-96 m-auto rounded-xl relative text-white ">

        {{--                <img class="relative object-cover w-full h-full rounded-xl" src="{{asset('assets/images/card.png')}}">--}}

        <div class="w-full px-8 absolute top-8">
            <h3 class="text-center text-black mb-4 ml-0 font-bold text-2xl">Reason</h3>
            <div class="flex justify-center">
                <div>
                    <textarea class="text-black" name="description" id="" cols="30" rows="7"></textarea>
                </div>
            </div>
            <div class="pt-1 flex justify-around">
                <button wire:click="$emit('closeModal')" class="bg-green-500 hover:bg-green-700  text-white font-bold py-2 px-8 rounded-sm text-xl mt-14">
                    Ok
                </button>
                <button  wire:click="$emit('closeModal')" class="bg-red-500 hover:bg-red-700  text-white font-bold py-2 px-4 rounded-sm text-xl mt-14">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
