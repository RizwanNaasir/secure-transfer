@php use App\Models\User; @endphp
@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <?php
        $user = auth()->user();
    $document1 = auth()->user()?->getFirstMediaUrl(User::DOCUMENTS_COLLECTION1);
    $document2 = auth()->user()?->getFirstMediaUrl(User::DOCUMENTS_COLLECTION2);
    ?>
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
                <div>
                    @if(auth()->check())
                        @if((blank($document1) && blank($document2)))
                            <span x-data="{ document: true }">
                            <div x-show="document" class="bg-red-100 border border-red-400 mb-5 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Document !</strong>
                                <span class="block sm:inline">Upload your document</span>
                                <span> <a class="underline hover:no-underline underline-offset-2 text-sm font-semibold " href="{{url('/panel/users/'.auth()->user()?->id.'/edit')}}">Click here</a></span>
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                 <svg @click="document = !document" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                </span>
                            </div>
                        </span>
                        @endif
                        @if(!$user?->is_approved_by_admin)
                            <span x-data="{ verify: true }">
                            <div x-show="verify" class="bg-yellow-100 border border-yellow-400 text-black px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Verified!</strong>
                                <span class="block sm:inline">Admin verify your document. you will get response in 48 hours.</span>
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                    <svg @click="verify = !verify" class="fill-current h-6 w-6 text-yellow-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                 </span>
                            </div>
                        </span>
                        @endif
                    @endif
                </div>



                <div class="flex justify-end">
                    <button onclick="window.location.href='{{url('panel/products/create')}}'" type="button"
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
