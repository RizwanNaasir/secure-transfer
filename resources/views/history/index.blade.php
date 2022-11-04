@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <div class="min-h-full">
        <main class="p-10">
            <div class="mb-4 p-10 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab"
                    data-tabs-toggle="#myTabContent"
                    role="tablist">
                    <li class="mr-2" role="presentation">
                        <button onclick="location.href='{{route('contract.list','sent')}}'"
                            @class([
                                'inline-block p-4 rounded-t-lg hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500' => $tab !== 'sent',
                                'border-b-2 inline-block p-4 text-blue-600 rounded-t-lg hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500' => $tab === 'sent',
                            ])>
                            Sent
                        </button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button onclick="location.href='{{route('contract.list','received')}}'"
                            @class([
                                'inline-block p-4 rounded-t-lg   hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500' => $tab !== 'received',
                                'border-b-2 inline-block p-4 text-blue-600 rounded-t-lg hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500' => $tab === 'received',
                            ])>
                            Received
                        </button>
                    </li>
                </ul>
            </div>
            @if($tab == 'sent')
                <livewire:history.sent :tab="$tab"/>
            @elseif($tab == 'received')
                <livewire:history.received :tab="$tab"/>
            @endif
        </main>
    </div>
@endsection
