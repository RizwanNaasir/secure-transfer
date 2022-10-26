<div class="grid grid-cols-2 gap-4 p-6 sm:p-12 z-40">
    <div class="h-32 md:h-auto md:w-full ">
        <img class="object-cover w-full h-full rounded-lg" src="https://source.unsplash.com/user/erondu/1600x900"
             alt="img" />
    </div>
    <div class="w-full">
        <div class="flex justify-center">
            <h2 class="text-2xl">Login</h2>
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
        <div class="flex items-left justify-between mt-2">
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                </div>
                <div class="ml-3 text-sm">
                    <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                </div>
            </div>

            <button
                class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500 text-right"
                onclick="Livewire.emit('openModal', 'forget-password')">
                Forgot password?
            </button>
{{--            <a href="{{url('forgetPassword')}}" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500 text-right">Forgot password?</a>--}}
        </div>
        <button
            class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue"
            href="#">
            Submit
        </button>

        {{--                        <div class="mt-4 text-center">--}}
        {{--                            <p class="text-sm">Don't have an account yet? <a href="{{url('SignUp')}}"--}}
        {{--                                                                             class="text-blue-600 hover:underline">--}}
        {{--                                    Sign up.</a></p>--}}
        {{--                        </div>--}}
    </div>
</div>
