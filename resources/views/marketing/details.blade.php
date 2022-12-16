@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <div class="bg-white">
        <section
            class="mx-auto max-w-auto py-16 px-4 sm:py-24 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-2 lg:gap-x-8 lg:px-8"
            style="padding-top: 0px">
            <!-- Product details -->
            <div class="lg:max-w-lg lg:self-end">
                <div class="mt-4">
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{$product->name}}</h1>
                </div>

                <section aria-labelledby="information-heading" class="mt-4">
                    <h2 id="information-heading" class="sr-only">Product information</h2>

                    <div class="flex items-center">
                        <p class="text-lg text-gray-900 sm:text-xl">${{$product->price}}</p>

                        <div class="ml-4 border-l border-gray-300 pl-4">
                            <h2 class="sr-only">Reviews</h2>
                            <div class="flex items-center">
                                <div>
                                    <div class="flex items-center">
                                        <svg class="text-yellow-400 h-5 w-5 flex-shrink-0"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                  d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                                  clip-rule="evenodd"/>
                                        </svg>

                                        <!-- Heroicon name: mini/star -->
                                        <svg class="text-yellow-400 h-5 w-5 flex-shrink-0"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                  d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                                  clip-rule="evenodd"/>
                                        </svg>

                                        <!-- Heroicon name: mini/star -->
                                        <svg class="text-yellow-400 h-5 w-5 flex-shrink-0"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                  d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                                  clip-rule="evenodd"/>
                                        </svg>

                                        <!-- Heroicon name: mini/star -->
                                        <svg class="text-yellow-400 h-5 w-5 flex-shrink-0"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                  d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                                  clip-rule="evenodd"/>
                                        </svg>

                                        <!-- Heroicon name: mini/star -->
                                        <svg class="text-gray-300 h-5 w-5 flex-shrink-0"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                  d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <p class="sr-only">4 out of 5 stars</p>
                                </div>
                                <p class="ml-2 text-sm text-gray-500">1624 reviews</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 space-y-6">
                        <p class="text-base text-gray-500">{{$product->description}}.</p>
                    </div>

                </section>
            </div>

            <!-- Product image -->
            <div class="mt-10 lg:col-start-2 lg:row-span-2 lg:mt-0 lg:self-center">
                <div class="aspect-w-1 aspect-h-1 overflow-hidden rounded-lg">
                    <img src="{{$product->full_image}}" class="h-full w-full object-cover object-center">
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

                <button onclick="Livewire.emit('openModal','send-contract-from-market')"
                        class="flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 py-3 px-8 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">
                    Make Contract
                </button>
            </div>
        </section>
    </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script src="https://commerce.coinbase.com/v1/checkout.js?version=201807">
    </script>
@endsection
