@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <div class="bg-white">
        <div class="mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:px-8 lg:py-24">
            <div class="space-y-12">
                <div class="grid grid-cols-3">
                    <div class="col-span-3 text-center">
                        <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">
                            {{ __('lang.market_place') }}
                        </h2>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button onclick="window.location.href='{{url('app/products/create')}}'" type="button"
                            class=" text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">{{ __('lang.add_product') }}</button>
                </div>
                <ul role="list" class="space-y-12 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 sm:space-y-0 lg:grid-cols-4 lg:gap-x-8 gap-8">
                    @foreach($products as $product)
                        <x-product.card :product="$product"/>
                    @endforeach
                    <!-- More people... -->
                </ul>
            </div>
        </div>
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#hide").hover(function(){
            $(".sample").show();
        },function(){
            $(".sample").hide();
        });
    });
</script>
