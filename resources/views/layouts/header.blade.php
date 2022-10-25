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
                   class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">Home</a>
                @if(!isset($hideLinks))
                    <a href="#"
                       class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">About</a>
                    <button
                       class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"
                       onclick="Livewire.emit('openModal', 'login')">Login</button>
                    <button
                       class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"
                       onclick="Livewire.emit('openModal', 'register')">Sign Up</button>
                @endif
            </div>
        </div>
    </div>
</header>
