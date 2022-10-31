@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <div class="flex justify-center items-center mt-20">
        <div class="space-y-16">
            <div class="w-96 h-96 m-auto rounded-xl relative text-white shadow-md transition-transform transform hover:scale-105 hover:shadow-2xl">

                {{--                <img class="relative object-cover w-full h-full rounded-xl" src="{{asset('assets/images/card.png')}}">--}}

                <div class="w-full px-8 absolute top-8">
                    <div class="flex justify-center">
                        <dl>
                            <h3 class="text-center text-black mb-0 ml-0 font-bold text-2xl"></h3>
                            <div>
                                <i class="fa-regular fa-circle-check bg-success-500 fa-10x rounded-full"></i>
                                <h4 class="text-black text-center mt-2">Payment Release</h4>

                                <h1 class="text-black text-center font-bold text-2xl">Successfully</h1>
                            </div>
                            <br>


                        </dl>

                    </div>
{{--                    <div class="pt-1 flex justify-around">--}}
{{--                        <button class="bg-green-500 hover:bg-green-700  text-white font-bold py-2 px-8 rounded-sm text-xl mt-14">--}}
{{--                            Ok--}}
{{--                        </button>--}}
{{--                        <button class="bg-red-500 hover:bg-red-700  text-white font-bold py-2 px-4 rounded-sm text-xl mt-14">--}}
{{--                            Cancel--}}
{{--                        </button>--}}
{{--                    </div>--}}
                    <div class="pt-6 pr-6">
                        <div class="flex justify-between">

                            <div class="">
                            </div>

                            <div class="">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
