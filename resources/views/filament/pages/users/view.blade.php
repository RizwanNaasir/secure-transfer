<x-filament::page>
    @php($recipient = $this->user)
    <div class="min-h-full">
        <main class="py-10">
            <!-- Page header -->
            <div class="mx-auto max-w-full px-4 sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8 mb-4" style="margin-bottom: 2%">
                <div class="flex items-center space-x-5">
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <img class="h-16 w-16 rounded-full" src="{{$recipient->avatar}}" alt="">
                        </div>
                    </div>
               {{--     <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{$recipient->fullname}}</h1>
                    </div>--}}
                </div>
            </div>

            <div class="mx-auto mt-8 grid max-w-full grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-2">
                <div class="space-y-6 lg:col-span-2 lg:col-start-1">
                    <h1 class="text-2xl font-bold text-gray-900">{{$recipient->fullname}}</h1>
                    <!-- Description list-->
                    <section aria-labelledby="applicant-information-title">
                        <div class="bg-grey shadow sm:rounded-lg py-12 " style="padding-top: 0%" >
                            <div class="flex-row px-4 py-5 sm:px-6">
                            </div>
                            <div class=" border-t border-gray-200 px-4 py-10 sm:px-6">
                                <dl class=" grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2" style="margin-top: 2%;row-gap: 10%">
                                    <div class=" sm:col-span-1">
                                        <dt class=" text-sm font-medium text-gray-500">Name</dt>
                                        <dd class=" mt-1 text-sm text-white-900">{{$recipient->fullname}}</dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Email address</dt>
                                        <dd class="mt-1 text-sm text-white-900">{{$recipient->email}}</dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                        <dd class="mt-1 text-sm text-white-900">{{$recipient->phone}}</dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                                        <dd class="mt-1 text-sm text-white-900">{{ucfirst($recipient->status)}}</dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Download Image</dt>
                                        <dd  class="mt-1 text-sm text-gray-900">
                                            @if(!empty($recipient->document1))
                                                <a href="{{asset('media/'.$recipient->document1)}}">
                                                    <svg class="w-8 h-8" fill="white" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg></dd>
                                                </a>
                                            @endif

                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Download Pdf File</dt>
                                        <dd class="mt-1 text-sm text-gray-900 flex flex-row">
                                            @if(!empty($recipient->document2))
                                                <a href="{{asset('media/'.$recipient->document2)}}">
                                                    <svg class="w-8 h-8" fill="white" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                </a>
                                            @endif

                                        </dd>
                                    </div>
{{--                                        <div class="sm:col-span-2">--}}
{{--                                            <dt class="text-sm font-medium text-gray-500">Attachment</dt>--}}
{{--                                            <dd class="mt-1 text-sm text-gray-900">--}}
{{--                                                <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">--}}
{{--                                                    <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">--}}
{{--                                                        <div class="flex w-0 flex-1 items-center">--}}
{{--                                                            <!-- Heroicon name: mini/paper-clip -->--}}
{{--                                                            <svg class="h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                                                                <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />--}}
{{--                                                            </svg>--}}
{{--                                                            <span class="ml-2 w-0 flex-1 truncate"></span>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="ml-4 flex-shrink-0">--}}
{{--                                                            <a href="" target="_blank" download--}}
{{--                                                               class="font-medium text-blue-600 hover:text-blue-500">Download</a>--}}
{{--                                                        </div>--}}
{{--                                                    </li>--}}
{{--                                                </ul>--}}
{{--                                            </dd>--}}
{{--                                        </div>--}}


{{--                                        <div class="sm:col-span-2">--}}
{{--                                            <dt class="text-sm font-medium text-gray-500">QR Code</dt>--}}
{{--                                            <dd class="m-2 text-sm text-gray-900">--}}
{{--                                            </dd>--}}
{{--                                        </div>--}}


{{--                                        <div class="inline-flex gap-6 flex-row-reverse rounded-md shadow-sm sm:col-span-2" role="group">--}}
{{--                                            <button type="button" onclick="Livewire.emit('openModal', 'contracts.accept')"--}}
{{--                                                    class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">--}}
{{--                                                <span class="ml-2">Approve </span>--}}
{{--                                            </button>--}}
{{--                                            <button type="button"  onclick="Livewire.emit('openModal', 'contracts.decline')"  class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">--}}
{{--                                                <span class="ml-2">Decline</span>--}}
{{--                                            </button>--}}
{{--                                        </div>--}}

                                </dl>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>

</x-filament::page>
