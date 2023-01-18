@extends('layouts.app')
@section('content')
    @include('layouts.header')

    <div class="grid grid-flow-row-dense md:grid-cols-8 sm:grid-cols-1 gap-4 mx-8 mb-5">
        <div class="col-span-2">
            <div class="container mx-auto pr-4 ">
                <div
                        class="w-72 bg-white max-w-xs mx-auto rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
                    <div class="h-20 bg-purple-400 flex items-center justify-between">
                        <p class="mr-0 text-white text-lg pl-5">Current active contact</p>
                    </div>
                    <div class="flex justify-between pt-6 px-5 mb-2 text-sm text-gray-600">
                        <p class="flex md:justify-around">STATUS : <span
                                    class="text-sm ml-5 text-black">{{\Str::upper($currentActiveContract->status->status)}}</span>
                        </p>
                    </div>
                    <p class="py-4 text-3xl ml-5">Amount: <small>{{$currentActiveContract->amount}}$</small></p>
                    <!-- <hr > -->
                </div>
            </div>
        </div><!---== First Stats Container ====--->

        <!---== Second Stats Container ====--->
        <div class="col-span-2">
            <div class="container mx-auto pr-4">
                <div
                        class="w-72 bg-white max-w-xs mx-auto rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
                    <div class="h-20 bg-blue-500 flex items-center justify-between">
                        <p class="mr-0 text-white text-lg pl-5">Total amount receives</p>
                    </div>
                    <div class="flex justify-between px-5 pt-6 mb-2 text-sm text-gray-600">
                        <p>TOTAL</p>
                    </div>
                    <p class="py-4 text-3xl ml-5">{{$totalAmountReceived}}$</p><!-- <hr > -->
                </div>
            </div>
        </div>
        <div class="col-span-2">
            <div class="container mx-auto pr-4">
                <div
                        class=" w-72 bg-white max-w-xs mx-auto rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer rounded-xl">
                    <div class=" h-20 bg-red-400 flex items-center justify-between">
                        <p class="mr-0 text-white text-lg pl-5">Total no. of contacts</p>
                    </div>
                    <div class="flex justify-between px-5 pt-6 mb-2 text-sm text-gray-600">
                        <p>TOTAL</p>
                    </div>
                    <p class="py-4 text-3xl ml-5">{{$totalNumberOfContracts}}</p>
                    <!-- <hr > -->
                </div>
            </div>
        </div>
        <!---== Third Stats Container ====--->

        <!---== Fourth Stats Container ====--->
        <div class="col-span-2">
            <div class="container mx-auto">
                <div
                        class="w-72 bg-white max-w-xs mx-auto rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
                    <div class="h-20 bg-purple-900 flex items-center justify-between">
                        <p class="mr-0 text-white text-lg pl-5">Total amount sent</p>
                    </div>
                    <div class="flex justify-between pt-6 px-5 mb-2 text-sm text-gray-600">
                        <p>TOTAL</p>
                    </div>
                    <p class="py-4 text-3xl ml-5">{{$totalAmountSent}}$</p>
                    <!-- <hr > -->
                </div>
            </div>
        </div>
        <div class="col-span-8">
            <p class="p-2 font-bold">
                Active Contracts
            </p>
            <livewire:dashboard.active-contracts/>
        </div>
    </div>

    <div class=" grid grid-cols-1 md:grid-cols-4 sm:grid-cols-1  gap-4 px-12 flex justify-center">
        <div class="col-span-2 md:col-span-1 sm:col-span-2">
            <div class="shadow-lg rounded-lg overflow-hidden">
                <div class="py-3 px-5 bg-gray-50">Bar chart</div>
                {!! $chart1->renderHtml() !!}
                {!! $chart1->renderChartJsLibrary() !!}
                {!! $chart1->renderJs() !!}
            </div>
        </div>
        <div class="col-span-2 md:col-span-1: sm:col-span-2 ml-2">
            <div class="shadow-lg rounded-lg overflow-hidden">
                <div class="py-3 px-5 bg-gray-50">Line chart</div>
                {!! $chart2->renderHtml() !!}
                {!! $chart2->renderChartJsLibrary() !!}
                {!! $chart2->renderJs() !!}
            </div>
        </div>
    </div>
@endsection
