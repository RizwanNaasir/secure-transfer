@extends('layouts.app')
@section('content')
    @include('layouts.header',[ 'hideLinks' => true])
<main class="-mt-0">{{--Start Contact us form--}}
    <div class="flex items-center min-h-[20%]  bg-white">
        <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
            <div class="">
                <h1 class="text-center text-4xl my-8 font-bold">Registeration</h1>
            </div>
            <div class="flex flex-col md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2 w-[80%] ml-12 mb-6">
                    <img class="object-cover w-full h-full" src="https://source.unsplash.com/user/erondu/1600x900"
                         alt="img"/>
                </div>
            </div>
        </div>
    </div>
    {{--End Contact us form--}}
</main>

@endsection
