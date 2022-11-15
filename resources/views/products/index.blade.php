@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <div class="p-24">
        <livewire:products.product />
    </div>
@endsection
