@extends('layouts.app')
@section('content')
    <script>
        window.onload = (event) => {
            Livewire.emit('openModal', 'contracts.payment-approved');
        };
    </script>
@endsection
