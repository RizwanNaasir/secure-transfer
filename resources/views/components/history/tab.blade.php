@props(['contracts','tab'])

<div {{ $attributes->class(['p-4 bg-gray-50 rounded-lg dark:bg-gray-800']) }} {{$attributes}}
     aria-labelledby="profile-tab">
    <div class="overflow-hidden bg-white shadow sm:rounded-md p-10 px-12">
        <ul role="list" class="divide-y divide-gray-200">
            @forelse($contracts as $contract)
                @php
                    $tab === 'sent' ? $user = $contract->recipient->first() : $user = $contract->user->first();
                    $tab === 'sent' ? $route = url('contract/details',$contract->id) : $route = url('contract/details/'.$contract->id. '?from-sender=1');
                @endphp
                <li>
                    <a href="{{$route}}" class="block hover:bg-gray-50">
                        <div class="flex items-center px-4 py-4 sm:px-6">
                            <div class="flex min-w-0 flex-1 items-center">
                                <div class="flex-shrink-0">
                                    <img class="h-12 w-12 rounded-full"
                                         src="{{$user->full_avatar}}" alt="">
                                </div>
                                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                    <div class="hidden md:block">
                                        <p class="truncate text-sm font-medium text-indigo-600">{{$user->full_name}}</p>
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
                                                    class="truncate">{{$user->email}}</span>
                                        </p>
                                    </div>
                                    <div class="">
                                        <div>
                                            <p class="text-md text-gray-900">
                                                Amount:
                                                <time class="font-normal">{{$contract->amount}}$</time>
                                            </p>
                                            <p class="mt-2 flex items-center text-sm text-gray-500">
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
