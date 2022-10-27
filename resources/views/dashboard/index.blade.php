@extends('layouts.app')
@section('content')
@include('layouts.header')
            <style>
                body {
                    font-family: 'IBM Plex Mono', sans-serif;
                }
                [x-cloak] {
                    display: none;
                }

                .line {
                    background: repeating-linear-gradient(
                        to bottom,
                        #eee,
                        #eee 1px,
                        #fff 1px,
                        #fff 8%
                    );
                }
                .tick {
                    background: repeating-linear-gradient(
                        to right,
                        #eee,
                        #eee 1px,
                        #fff 1px,
                        #fff 5%
                    );
                }
            </style>

<div class="flex justify-center bg-gray-100 py-10 p-14">
    <!---== First Stats Container ====--->
    <div class="container mx-auto pr-4 ">
        <div class=" w-72 bg-white max-w-xs mx-auto rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer rounded-xl">
            <div class=" h-20 bg-red-400 flex items-center justify-between">
                <p class="mr-0 text-white text-lg pl-5">Total no. of contacts</p>
            </div>
            <div class="flex justify-between px-5 pt-6 mb-2 text-sm text-gray-600">
                <p>TOTAL</p>
            </div>
            <p class="py-4 text-3xl ml-5">15</p>
            <!-- <hr > -->
        </div>
    </div>
    <!---== First Stats Container ====--->

    <!---== Second Stats Container ====--->
    <div class="container mx-auto pr-4">
        <div class="w-72 bg-white max-w-xs mx-auto rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
            <div class="h-20 bg-blue-500 flex items-center justify-between">
                <p class="mr-0 text-white text-lg pl-5">Total amount receive</p>
            </div>
            <div class="flex justify-between px-5 pt-6 mb-2 text-sm text-gray-600">
                <p>TOTAL</p>
            </div>
            <p class="py-4 text-3xl ml-5">5000$</p>
            <!-- <hr > -->
        </div>
    </div>
    <!---== Second Stats Container ====--->

    <!---== Third Stats Container ====--->
    <div class="container mx-auto pr-4">
        <div class="w-72 bg-white max-w-xs mx-auto rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
            <div class="h-20 bg-purple-400 flex items-center justify-between">
                <p class="mr-0 text-white text-lg pl-5">Current active contact</p>
            </div>
            <div class="flex justify-between pt-6 px-5 mb-2 text-sm text-gray-600">
                <p class="flex md:justify-around">STATUS : <span class="text-sm ml-5 text-black">IN PROCESS</span></p>
            </div>
            <p class="py-4 text-3xl ml-5">Amount: <small>3500$</small></p>
            <!-- <hr > -->
        </div>
    </div>
    <!---== Third Stats Container ====--->

    <!---== Fourth Stats Container ====--->
    <div class="container mx-auto">
        <div class="w-72 bg-white max-w-xs mx-auto rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
            <div class="h-20 bg-purple-900 flex items-center justify-between">
                <p class="mr-0 text-white text-lg pl-5">Total amount send</p>
            </div>
            <div class="flex justify-between pt-6 px-5 mb-2 text-sm text-gray-600">
                <p>TOTAL</p>
            </div>
            <p class="py-4 text-3xl ml-5">10000$</p>
            <!-- <hr > -->
        </div>
    </div><!---== Fourth Stats Container ====--->
</div>

<div class="grid grid-cols-4 gap-4 px-12">
    <div class="col-span-2">
        <div class="shadow-lg rounded-lg overflow-hidden">
            <div class="py-3 px-5 bg-gray-50">Bar chart</div>
            <canvas class="p-10" id="chartBar"></canvas>
        </div>
    </div>
        <div class="col-span-2 ml-2">
            <div class="shadow-lg rounded-lg overflow-hidden">
                <div class="py-3 px-5 bg-gray-50">Line chart</div>
                <canvas class="p-10" id="chartLine"></canvas>
            </div>
        </div>
</div>

<!-- Required chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart line -->
<script>
    const labels = ["January", "February", "March", "April", "May", "June"];
    const data = {
        labels: labels,
        datasets: [
            {
                label: "My First dataset",
                backgroundColor: "hsl(252, 82.9%, 67.8%)",
                borderColor: "hsl(252, 82.9%, 67.8%)",
                data: [0, 10, 5, 2, 20, 30, 45],
            },
        ],
    };

    const configLineChart = {
        type: "line",
        data,
        options: {},
    };

    var chartLine = new Chart(
        document.getElementById("chartLine"),
        configLineChart
    );
</script>
<!-- Required chart.js -->
<!-- Chart bar -->
<script>
    const labelsBarChart = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
    ];
    const dataBarChart = {
        labels: labelsBarChart,
        datasets: [
            {
                label: "My First dataset",
                backgroundColor: "hsl(252, 82.9%, 67.8%)",
                borderColor: "hsl(252, 82.9%, 67.8%)",
                data: [0, 10, 5, 2, 20, 30, 45],
            },
        ],
    };

    const configBarChart = {
        type: "bar",
        data: dataBarChart,
        options: {},
    };

    var chartBar = new Chart(
        document.getElementById("chartBar"),
        configBarChart
    );
</script>
@endsection
