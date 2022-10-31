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
                            <h3 class="text-center text-black mb-4 ml-0 font-bold text-2xl">Reason</h3>
                            <div>
                                <textarea class="text-black" name="description" id="" cols="30" rows="7"></textarea>
                            </div>
                        </dl>

                    </div>
                    <div class="pt-1 flex justify-around">
                        <button class="bg-green-500 hover:bg-green-700  text-white font-bold py-2 px-8 rounded-sm text-xl mt-14">
                            Ok
                        </button>
                        <button class="bg-red-500 hover:bg-red-700  text-white font-bold py-2 px-4 rounded-sm text-xl mt-14">
                            Cancel
                        </button>
                    </div>
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
