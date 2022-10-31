@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <div class="flex justify-center items-center mt-20">
        <div class="space-y-16">
            <div class="w-96 h-56 m-auto bg-red-100 rounded-xl relative text-white shadow-md transition-transform transform hover:scale-105 hover:shadow-2xl">

                <img class="relative object-cover w-full h-full rounded-xl" src="{{asset('assets/images/card.png')}}">

                <div class="w-full px-8 absolute top-8">
                    <div class="flex justify-between">
                        <div class="">
                            <p class="font-light">
                                Name
                                </h1>
                            <p class="font-bold tracking-widest font-mono">
                                Ali yousaf
                                <i class="fa-solid fa-pen-to-square"></i>
                            </p>
                        </div>
                        <img class="w-14" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1000px-Mastercard-logo.svg.png"/>
                    </div>
                    <div class="pt-1">
                        <p class="font-light">
                            Num.
                            </h1>
                        <p class="font-medium tracking-more-wider font-mono">
                            <strong>4111</strong> <strong>1111</strong>   1111  1111 <i class="fa-solid fa-pen-to-square"></i>
                        </p>

                    </div>
                    <div class="pt-6 pr-6">
                        <div class="flex justify-between">

                            <div class="">
                                <p class="font-medium tracking-wider text-sm font-mono">
                                    Crypto Detail:
                                    </h1>
                                <p class="font-medium tracking-wider text-sm font-mono">
                                    Crypto Address: <strong> 0x187436283764372 <span><i class="fa-solid fa-pen-to-square"></i></span> </strong>
                                </p>
                            </div>

                            <div class="">
                                <p class="font-light text-xs">
                                    CVC
                                    </h1>
                                <p class="font-bold tracking-more-wider text-sm font-mono">
                                    123
                                    <span><i class="fa-solid fa-pen-to-square"></i></span>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
