<header>
    <div class="relative bg-white">
        <div
            class="mx-auto flex max-w-7xl items-center justify-between px-4 py-6 sm:px-6 md:justify-start md:space-x-10 lg:px-8">
            <div class="flex justify-start lg:w-0 lg:flex-1">
                <a href="#">
                    <span class="sr-only">Your Company</span>
                    <img class="h-8 w-auto sm:h-10"
                         src="https://tailwindui.com/img/logos/mark.svg?from-color=purple&from-shade=600&to-color=indigo&to-shade=600&toShade=600"
                         alt="">
                </a>
            </div>
            <div class="items-center justify-end md:flex md:flex-1 lg:w-0 gap-4 md:gap-4">
                <a href="{{url('/')}}"
                   class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
                    Home
                </a>
                <a href="{{url('/')}}"
                   class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
                    Add new Contact
                </a>
                <a href="{{url('/')}}"
                   class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
                    History
                </a>
                @if(!isset($hideLinks))
                    <a href="#"
                       class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">About</a>
                    <button
                       class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"
                       onclick="Livewire.emit('openModal', 'login')">
                        Login
                    </button>
                    <button
                       class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"
                       onclick="Livewire.emit('openModal', 'register')">
                        Sign Up
                    </button>
                @endif
                <div class="flex justify-center items-center">
                    <div x-data="{ open: false }" class=" flex justify-center items-center z-50">
                        <div @click="open = !open" class="relative py-3" :class="{'border-indigo-700 transform transition duration-300 ': open}" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100">
                            <div class="flex justify-center items-center space-x-3 cursor-pointer">
                                <div class="w-12 h-12 rounded-full overflow-hidden border-2 dark:border-white border-gray-900">
                                    <img src="https://images.unsplash.com/photo-1610397095767-84a5b4736cbd?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80" alt="" class="w-full h-full object-cover">
                                </div>
{{--                                <div class="font-semibold dark:text-white text-gray-900 text-lg">--}}
{{--                                    <div class="cursor-pointer">Hasan Muhammad</div>--}}
{{--                                </div>--}}
                            </div>
                            <div x-show="open" style="left: -212px; top: 65px;" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute w-60 px-5 py-3 dark:bg-gray-800 bg-white rounded-lg shadow border dark:border-transparent mt-5">
                                <ul class="space-y-3">
                                    <li class="font-medium">
                                        <a href="{{url('userProfile')}}" class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700">
                                            <div class="mr-3">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            </div>
                                            Edit Profile
                                        </a>
                                    </li>
                                    <li class="font-medium">
                                        <button onclick="Livewire.emit('openModal', 'change-password')" class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700">
                                            <div class="mr-3">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            </div>
                                            Change Password
                                        </button>
                                    </li>
                                    <li class="font-medium">
                                        <a href="#" class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700">
                                            <div class="mr-4 ml-1">
{{--                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>--}}
                                                <i class="fa-regular fa-credit-card"></i>
                                            </div>
                                            Payment Method
                                        </a>
                                    </li>
                                    <hr class="dark:border-gray-700">
                                    <li class="font-medium">
                                        <a href="#" class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-red-600">
                                            <div class="mr-3 text-red-600">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                            </div>
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</header>
