@extends('layouts.app')
@section('content')
@include('layouts.header')
<main class="mx-auto flex w-full max-w-7xl flex-grow flex-col px-4 sm:px-6 lg:px-8">
    <div class="my-auto flex-shrink-0 py-16 sm:py-32">
        <p class="text-base font-semibold text-indigo-600">404</p>
        <h1 class="mt-2 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Sorry, we couldn’t find the page you’re looking for.</h1>
        <p class="mt-2 text-base text-gray-500">{{__(str_replace('model [App\Models\\', '[', $exception->getMessage()) ?: 'Not Found')}}</p>
        <div class="mt-6">
            <a href="{{url('/')}}" class="text-base font-medium text-indigo-600 hover:text-indigo-500">
                Go back home
                <span aria-hidden="true"> &rarr;</span>
            </a>
        </div>
    </div>
</main>
@include('layouts.footer')
@endsection

