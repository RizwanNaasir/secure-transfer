@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <main class="-mt-0 px-10">
        <div class="space-y-0 divide-y divide-gray-200">
            <livewire:user.edit-profile />
        </div>
    </main>
@endsection
