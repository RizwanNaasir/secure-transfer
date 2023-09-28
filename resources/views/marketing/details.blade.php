@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <div class="bg-white">
        <section
                class="mx-auto max-w-auto py-16 px-4 sm:py-24 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-2 lg:gap-x-8 lg:px-8"
                style="padding-top: 0">
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
                                <x-average-ratings :model="$product"/>
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
                @php session()->put('product_id',$product->id) @endphp
                @if($product->authUserIsOwner())
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
@endsection
