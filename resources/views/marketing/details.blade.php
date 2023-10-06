@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <div class="bg-white">
        <section
                class="mx-auto max-w-auto py-16 px-4 sm:py-24 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-2 lg:gap-x-8 lg:px-8"
                style="padding-top: 0">
            <!-- Product details -->
            <div class="lg:max-w-lg lg:self-end">
                @if(Session::has('message'))
                <div class="lg:ml-16 md:ml-16 mt-5">
                    <div id="alert-3" class="flex items-center p-4  text-green-800 rounded-lg bg-green-50" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ml-3 text-sm font-medium">
                            {{Session::get('message')}}
                        </div>
                        <button type="button" id="remove-message-button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                </div>
                @endif
                <div class="mt-4">
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{$product?->name}}</h1>
                </div>
                <section aria-labelledby="information-heading" class="mt-4">
                    <h2 id="information-heading" class="sr-only">Product information</h2>

                    <div class="flex items-center">
                        <p class="text-lg text-gray-900 sm:text-xl">${{$product?->price}}</p>

                        <div class="ml-4 border-l border-gray-300 pl-4">
                            <h2 class="sr-only">Reviews</h2>
                            <div class="flex items-center">
                                <x-average-ratings :model="$product"/>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 space-y-6">
                        <p class="text-base text-gray-500">{{$product?->description}}.</p>
                    </div>
                </section>
            </div>
            <!-- Product image -->
            <div class="mt-10 lg:col-start-2 lg:row-span-2 lg:mt-0 lg:self-center">
                <div class="aspect-w-1 aspect-h-1 overflow-hidden rounded-lg">
                    <img src="{{$product?->full_image}}" class="h-full w-full object-cover object-center">
                </div>
            </div>

            <!-- Product form -->
            {{--            <div class="mt-10 lg:col-start-1 lg:row-start-2 lg:max-w-lg lg:self-start">--}}
            {{--                <section aria-labelledby="options-heading">--}}
            {{--                    <h2 id="options-heading" class="sr-only">Product options</h2>--}}
            {{--                </section>--}}
            {{--            </div>--}}
            <div class="mt-10">

                {{--                <div class="sr-only">--}}
                {{--                    <a class="buy-with-crypto"--}}
                {{--                       href="https://commerce.coinbase.com/checkout/9df6f47c-dbeb-4222-bbbb-db765da14d6f">--}}
                {{--                        Buy with Crypto--}}
                {{--                    </a>--}}

                {{--                </div>--}}
                @php session()->put('product_id',$product?->id) @endphp
                @if($product?->authUserIsOwner())
                    <button onclick=""
                            class="flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 py-3 px-8 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">
                        Edit Product
                    </button>
                @else
                    <livewire:send-contract-from-market/>
                @endif
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="https://commerce.coinbase.com/v1/checkout.js?version=201807">
    </script>

    <script>
        $(document).on('click', '#remove-message-button', function() {
            $.ajax({
                type: 'GET',
                url: '/remove-message',
                success: function(response) {
                    console.log('Session message removed.');
                    window.location.reload();
                },
                error: function(error) {
                    window.location.reload();
                }
            });
        });
    </script>
@endsection
