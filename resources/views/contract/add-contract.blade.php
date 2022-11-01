@extends('layouts.app')
@section('content')
@include('layouts.header')
<div class="flex items-center min-h-screen bg-gray-50">
    <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
        <div class="flex flex-col md:flex-row">
            <div class="h-32 md:h-auto md:w-1/2">
{{--                <img class="object-cover w-full h-full" src="https://source.unsplash.com/user/erondu/1600x900"--}}
{{--                     alt="img" />--}}
            </div>
            <div class="w-full m-4">
                @livewire('contract-form')
            </div>
        </div>
    </div>
</div>

@endsection
