@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <div class="bg-white">
        <div class="mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:px-8 lg:py-24">
            <div class="space-y-12">
                <div class="grid grid-cols-3">
                    <div class="col-span-3 text-center">
                        <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Market Place</h2>
                    </div>
                </div>
                <ul role="list" class="space-y-12 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 sm:space-y-0 lg:grid-cols-4 lg:gap-x-8 gap-8">
                    @foreach($pics as $pic)
                    <li>
                        <a href="{{url('market_details')}}">
                        <div class="space-y-4">
                            <div class="object-cover shadow-lg h-[280px] w-auto h-[280px] w-auto">
                                <img class="rounded-lg " width="220" height="auto" src="{{$pic}}" alt="">
                            </div>

                            <div class="space-y-2">
                                <div class="space-y-1 text-lg font-medium leading-6">
                                    <h3>Lindsay Walton</h3>
                                    <price class="font-normal">12000$</price>
{{--                                    <price class="font-normal">12000$</price>--}}
                                </div>
                            </div>
                        </div>
                        </a>
                    </li>
                    @endforeach
{{--                    <li>--}}
{{--                        <a href="{{url('market_details')}}">--}}
{{--                        <div class="space-y-4">--}}
{{--                            <div class="object-cover shadow-lg h-[280px] w-auto h-[280px] w-auto">--}}
{{--                                <img class="rounded-lg" width="220" height="auto" src="{{asset('assets/images/camera.png')}}" alt="">--}}
{{--                            </div>--}}

{{--                            <div class="space-y-2">--}}
{{--                                <div class="space-y-1 text-lg font-medium leading-6">--}}
{{--                                    <h3>Lindsay Walton</h3>--}}
{{--                                    <price class="font-normal">12000$</price>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{url('market_details')}}">--}}
{{--                        <div class="space-y-4">--}}
{{--                            <div class="object-cover shadow-lg h-[280px] w-auto">--}}
{{--                                <img class="rounded-lg" width="220" height="auto" src="{{asset('assets/images/1.png')}}" alt="">--}}
{{--                            </div>--}}

{{--                            <div class="space-y-2">--}}
{{--                                <div class="space-y-1 text-lg font-medium leading-6">--}}
{{--                                    <h3>Lindsay Walton</h3>--}}
{{--                                    <price class="font-normal">12000$</price>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{url('market_details')}}">--}}
{{--                        <div class="space-y-4">--}}
{{--                            <div class="object-cover shadow-lg h-[280px] w-auto">--}}
{{--                                <img class="rounded-lg " width="220" height="auto" src="{{asset('assets/images/2.png')}}" alt="">--}}
{{--                            </div>--}}

{{--                            <div class="space-y-2">--}}
{{--                                <div class="space-y-1 text-lg font-medium leading-6">--}}
{{--                                    <h3>Lindsay Walton</h3>--}}
{{--                                    <price class="font-normal">12000$</price>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{url('market_details')}}">--}}
{{--                        <div class="space-y-4">--}}
{{--                            <div class="object-cover shadow-lg h-[280px] w-auto">--}}
{{--                                <img class="rounded-lg" width="220" height="auto" src="{{asset('assets/images/3.png')}}" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="space-y-2">--}}
{{--                                <div class="space-y-1 text-lg font-medium leading-6">--}}
{{--                                    <h3>Lindsay Walton</h3>--}}
{{--                                    <price class="font-normal">12000$</price>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{url('market_details')}}">--}}
{{--                        <div class="space-y-4">--}}
{{--                            <div class="object-cover shadow-lg h-[280px] w-auto">--}}
{{--                                <img class="rounded-lg" width="220" height="auto" src="{{asset('assets/images/camera.png')}}" alt="">--}}
{{--                            </div>--}}

{{--                            <div class="space-y-2">--}}
{{--                                <div class="space-y-1 text-lg font-medium leading-6">--}}
{{--                                    <h3>Lindsay Walton</h3>--}}
{{--                                    <price class="font-normal">12000$</price>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}

                    <!-- More people... -->
                </ul>
            </div>
        </div>
    </div>
@endsection