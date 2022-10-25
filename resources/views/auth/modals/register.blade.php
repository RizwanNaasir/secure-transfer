<div x-data="{ modelOpen: false }">
    <button @click="modelOpen =!modelOpen"
            onclick="event.preventDefault();"
            class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
        <span>{{$button ?? "View"}}</span>
    </button>

    <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
         aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
            <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"
            ></div>

            <div x-cloak x-show="modelOpen"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
            >
                <div class="flex items-center justify-between space-x-4">
                    <h1 class="text-xl font-medium text-gray-800 ">{{$title ?? "Title"}}</h1>

                    <button @click="modelOpen = false" onclick="event.preventDefault();"
                            class="text-gray-600 focus:outline-none hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </button>
                </div>
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex items-center justify-center p-6 sm:p-12 mt-6 ">
                    <div class="w-full">
                        <div class="flex justify-center">
                        </div>
                        <div>
                            <label class="block text-sm -mt-7">
                                First Name
                            </label>
                            <input type="text"
                                   class="w-full px-4 py-2 text-sm border rounded-md focus:border-blue-400 focus:outline-none focus:ring-1 focus:ring-blue-600"
                                   placeholder="Name"/>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm">
                                Last Name
                            </label>
                            <input type="text"
                                   class="w-full px-4 py-2 text-sm border rounded-md focus:border-blue-400 focus:outline-none focus:ring-1 focus:ring-blue-600"
                                   placeholder="Last Name"/>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm">
                                Email
                            </label>
                            <input type="email"
                                   class="w-full px-4 py-2 text-sm border rounded-md focus:border-blue-400 focus:outline-none focus:ring-1 focus:ring-blue-600"
                                   placeholder="Email Address"/>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm">
                                Password
                            </label>
                            <input
                                class="w-full px-4 py-2 text-sm border rounded-md focus:border-blue-400 focus:outline-none focus:ring-1 focus:ring-blue-600"
                                placeholder="Password" type="password"/>
                        </div>
                        <div>
                            <label class="block mt-4 text-sm">
                                Confirm Password
                            </label>
                            <input
                                class="w-full px-4 py-2 text-sm border rounded-md focus:border-blue-400 focus:outline-none focus:ring-1 focus:ring-blue-600"
                                placeholder="Password" type="password"/>
                        </div>
                        <button
                            class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue"
                            href="{{url('SignIn')}}">
                            Submit
                        </button>

{{--                        <div class="mt-4 text-center">--}}
{{--                            <p class="text-sm">Do have an account yet? <a href="{{url('SignIn')}}"--}}
{{--                                                                          class="text-blue-600 hover:underline">--}}
{{--                                    Sign in.</a></p>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
