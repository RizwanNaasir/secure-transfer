@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <div class="min-h-full">
        <main class="py-10">
            <!-- Page header -->
            <div class="mx-auto max-w-3xl px-4 sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8">
                <div class="flex items-center space-x-5">
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <img class="h-16 w-16 rounded-full" src="{{$recipient->full_avatar}}" alt="">
                            <span class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{$recipient->fullname}}</h1>
                        <x-average-ratings :model="$recipient"/>
                    </div>
                </div>
            </div>

            <div class="mx-auto mt-8 grid max-w-3xl grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
                <div class="space-y-6 lg:col-span-2 lg:col-start-1">
                    <!-- Description list-->
                    <section aria-labelledby="applicant-information-title">
                        <div class="bg-white shadow sm:rounded-lg">
                            <div class="flex-row px-4 py-5 sm:px-6">
                                <h2 id="applicant-information-title"
                                    class="text-lg font-medium leading-6 text-gray-900">
                                    {{ __('lang.contracts_detail') }}
                                    @if(!$contract->is_pending)
                                        <span style="float: right">
                                            <button type="button"
                                                    onclick="Livewire.emit('openModal', 'contracts.rating', {{ json_encode(["recipient_id" => $recipient->id]) }})"
                                                    class="flex flex-row-reverse text-white bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:focus:ring-yellow-800 shadow-lg shadow-yellow-500/50 dark:shadow-lg dark:shadow-yellow-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-4">
                                                <span class="ml-2">Rate This User</span>
                                            </button>
                                        </span>
                                    @endif
                                </h2>

                            </div>
                            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">{{ __('lang.name') }}</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{$recipient->fullname}}</dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">{{ __('lang.email') }}</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{$recipient->email}}</dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">{{ __('lang.amount') }}</dt>
                                        <dd class="mt-1 text-sm text-gray-900">${{$contract->amount}}</dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">{{__('lang.preferred')}}</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ucfirst($contract->preferred_payment_method)}}</dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">{{__('lang.description')}}</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{$contract->description}}</dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">{{ __('lang.status') }}</dt>
                                        <dd class="mt-1 text-sm text-gray-900 flex flex-row">
                                            @switch($contract->current_status)
                                                @case('Pending')
                                                    <x-pending class="mr-1.5 h-5 w-5"/>
                                                    @break
                                                @case('Declined')
                                                    <x-decline class="mr-1.5 h-5 w-5"/>
                                                    @break
                                                @case('Accepted')
                                                    <x-accepted class="mr-1.5 h-5 w-5"/>
                                                    @break
                                            @endswitch
                                            {{$contract->current_status}}
                                        </dd>
                                    </div>
                                    @if(isset($contract->file))
                                        <div class="sm:col-span-2">
                                            <dt class="text-sm font-medium text-gray-500">{{ __('lang.attachment') }}</dt>
                                            <dd class="mt-1 text-sm text-gray-900">
                                                <ul role="list"
                                                    class="divide-y divide-gray-200 rounded-md border border-gray-200">
                                                    <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                                        <div class="flex w-0 flex-1 items-center">
                                                            <!-- Heroicon name: mini/paper-clip -->
                                                            <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                 fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd"
                                                                      d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                                      clip-rule="evenodd"/>
                                                            </svg>
                                                            <span class="ml-2 w-0 flex-1 truncate">{{$contract->file_name}}</span>
                                                        </div>
                                                        <div class="ml-4 flex-shrink-0">
                                                            <a href="{{$contract->file_path}}" target="_blank" download
                                                               class="font-medium text-blue-600 hover:text-blue-500">{{ __('lang.download') }}</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </dd>
                                        </div>
                                    @endif
                                    @if($contract->has('products'))
                                        <dt class="text-sm font-medium text-gray-500">{{ __('lang.attached_products') }}</dt>
                                        <dd class="m-2 text-sm text-gray-900">
                                            <ul role="list" class="space-y-12 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 sm:space-y-0 lg:grid-cols-4 lg:gap-x-8 gap-8">
                                                @foreach($contract->products as $product)
                                                    <x-product.card :product="$product"/>
                                                @endforeach
                                                <!-- More people... -->
                                            </ul>
                                        </dd>
                                    @endif
                                    @if(!$fromSender and $contract->is_pending)
                                        <div class="sm:col-span-2">
                                            <dt class="text-sm font-medium text-gray-500">{{ __('lang.qr') }}</dt>
                                            <dd class="m-2 text-sm text-gray-900">
                                                {!! $contract->status->qr_code !!}
                                            </dd>
                                        </div>
                                    @endif
                                    @if($fromSender && $contract->is_pending)
                                        <div class="inline-flex gap-6 flex-row-reverse rounded-md shadow-sm sm:col-span-2"
                                             role="group">
                                            <button type="button"
                                                    onclick="Livewire.emit('openModal', 'contracts.accept')"
                                                    class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                                <span class="ml-2">{{ __('lang.approve') }} </span>
                                            </button>
                                            <button type="button"
                                                    onclick="Livewire.emit('openModal', 'contracts.decline')"
                                                    class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                                <span class="ml-2">{{__('lang.declined')}}</span>
                                            </button>
                                        </div>
                                    @endif
                                </dl>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>
@endsection
