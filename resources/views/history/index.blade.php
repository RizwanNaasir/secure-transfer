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
                        <button
                            class="inline-block p-4 rounded-t-lg border-b-2 text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500"
                            id="profile-tab" data-tabs-target="#profile" type="button" role="tab"
                            aria-controls="profile"
                            aria-selected="true">
                            Sent
                            <span class="inline-flex justify-center items-center ml-2 w-4 h-4 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                {{$contracts->count()}}
                              </span>
                        </button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button
                            class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700"
                            id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                            aria-controls="dashboard"
                            aria-selected="false">
                            Received
                            <span class="inline-flex justify-center items-center ml-2 w-4 h-4 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                {{ $receivedContracts->count() }}
                              </span>
                        </button>
                    </li>
                </ul>
            </div>
            <div id="myTabContent">
                <div class="p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="profile" role="tabpanel"
                     aria-labelledby="profile-tab">
                    <div class="overflow-hidden bg-white shadow sm:rounded-md p-10 px-12">
                        <ul role="list" class="divide-y divide-gray-200">
                            @forelse($contracts as $contract)
                                <li>
                                    <a href="{{url('contract/details',$contract->id)}}" class="block hover:bg-gray-50">
                                        <div class="flex items-center px-4 py-4 sm:px-6">
                                            <div class="flex min-w-0 flex-1 items-center">
                                                <div class="flex-shrink-0">
                                                    <img class="h-12 w-12 rounded-full"
                                                         src="{{$contract->recipient->first()->avatar}}" alt="">
                                                </div>
                                                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                    <div class="hidden md:block">
                                                        <p class="truncate text-sm font-medium text-indigo-600">{{$contract->recipient->first()->full_name}}</p>
                                                        <p class="mt-2 flex items-center text-sm text-gray-500">
                                                            <!-- Heroicon name: mini/envelope -->
                                                            <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                 fill="currentColor" aria-hidden="true">
                                                                <path
                                                                    d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z"/>
                                                                <path
                                                                    d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z"/>
                                                            </svg>
                                                            <span
                                                                class="truncate">{{$contract->recipient->first()->email}}</span>
                                                        </p>
                                                    </div>
                                                    <div class="">
                                                        <div>
                                                            <p class="text-md text-gray-900">
                                                                Amount:
                                                                <time class="font-normal">{{$contract->amount}}$</time>
                                                            </p>
                                                            <p class="mt-2 flex items-center text-sm text-gray-500">
                                                                <!-- Heroicon name: mini/check-circle -->
                                                                <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-green-400"
                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                     viewBox="0 0 20 20" fill="currentColor"
                                                                     aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                                                          clip-rule="evenodd"/>
                                                                </svg>
                                                                {{ucfirst($contract->status->status)}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <!-- Heroicon name: mini/chevron-right -->
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                          d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <div class="text-center">
                                    <p class="text-2xl font-bold">No Contracts</p>
                                </div>
                            @endforelse
                            @if($contracts->count() > 0)
                                <div class="mt-4">
                                    {{ $contracts->links() }}
                                </div>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="dashboard" role="tabpanel"
                     aria-labelledby="dashboard-tab">
                    <div class="overflow-hidden bg-white shadow sm:rounded-md p-10 px-12">
                        <ul role="list" class="divide-y divide-gray-200">
                            @forelse($receivedContracts as $contract)
                                <li>
                                    <a href="{{url('contract/details',$contract->id).'?from-sender=1'}}" class="block hover:bg-gray-50">
                                        <div class="flex items-center px-4 py-4 sm:px-6">
                                            <div class="flex min-w-0 flex-1 items-center">
                                                <div class="flex-shrink-0">
                                                    <img class="h-12 w-12 rounded-full"
                                                         src="{{$contract->user->first()->avatar}}" alt="">
                                                </div>
                                                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                    <div class="hidden md:block">
                                                        <p class="truncate text-sm font-medium text-indigo-600">{{$contract->user->first()->full_name}}</p>
                                                        <p class="mt-2 flex items-center text-sm text-gray-500">
                                                            <!-- Heroicon name: mini/envelope -->
                                                            <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                 fill="currentColor" aria-hidden="true">
                                                                <path
                                                                    d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z"/>
                                                                <path
                                                                    d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z"/>
                                                            </svg>
                                                            <span
                                                                class="truncate">{{$contract->user->first()->email}}</span>
                                                        </p>
                                                    </div>
                                                    <div class="">
                                                        <div>
                                                            <p class="text-md text-gray-900">
                                                                Amount:
                                                                <time class="font-normal">{{$contract->amount}}$</time>
                                                            </p>
                                                            <p class="mt-2 flex items-center text-sm text-gray-500">
                                                                <!-- Heroicon name: mini/check-circle -->
                                                                <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-green-400"
                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                     viewBox="0 0 20 20" fill="currentColor"
                                                                     aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                                                          clip-rule="evenodd"/>
                                                                </svg>
                                                                {{ucfirst($contract->status->status)}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <!-- Heroicon name: mini/chevron-right -->
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                          d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <div class="text-center">
                                    <p class="text-2xl font-bold">No Contracts</p>
                                </div>
                            @endforelse
                            @if($receivedContracts->count() > 0)
                                <div class="m-4">
                                    {{$receivedContracts->links()}}
                                </div>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </main>
    </div>

@endsection
