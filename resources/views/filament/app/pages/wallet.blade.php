@vite(['resources/css/app.css'])
<x-filament-panels::page>
    <div class="z-50">
        <section x-data="{modalOpen: false}">
            <x-filament::button @click="modalOpen = !modalOpen" class="w-32 bg-purple-600 float-right">
                <div class="flex flex-row">
                    Top up wallet
                </div>
            </x-filament::button>
            <div class="hidden" x-bind:class="{'hidden' : !modalOpen}">
                <div
                    x-show="modalOpen"
                    x-transition:enter="transition ease-out duration-300 transform opacity-0"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="                       z-100
                                                  bg-black bg-opacity-90
                                                  fixed
                                                  top-0
                                                  left-0
                                                  w-full
                                                  min-h-screen
                                                  h-full
                                                  flex
                                                  items-center
                                                  justify-center
                                                  px-4
                                                  py-5
                                                "
                >
                    <div
                        @click.outside="modalOpen = false"
                        class="
                                                    w-full
                                                    max-w-[570px]
                                                    rounded-[20px]
                                                    bg-white
                                                    py-12
                                                    px-8
                                                    md:py-[60px] md:px-[70px]
                                                    text-center
                                                  "
                    >

                        <div class="relative bg-white rounded-lg ">
                            <div class="px-6 py-6 lg:px-8">
                                <h3 class="mb-4 text-xl font-medium text-gray-900">Add Your Top up Wallet</h3>
                                <form class="space-y-6" action="{{route('stripe.top-up-wallet')}}">
                                    <div>
                                        <input type="number" max="10000" name="amount" wire:model="shop_url"
                                               id="amount"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                                               placeholder="Enter Amount"
                                               value="" required>
                                    </div>

                                    <button type="submit">
                                        <div class="flex flex-row bg-purple-700 px-5 text-white py-2 rounded-lg">
                                            Pay Now !
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="z-2">
        @livewire('wallet-overview')
    </div>
<div class="z-2">
    @livewire('list-transactions')
</div>
</x-filament-panels::page>
