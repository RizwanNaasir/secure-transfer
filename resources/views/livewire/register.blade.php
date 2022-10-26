<div class="grid grid-cols-1 sm:grid-cols-2 gap-3 p-6 sm:p-12 mt-6 z-50">
    <div class="h-32 md:h-auto md:w-full ">
        <img class="object-cover w-full h-full rounded-lg" src="https://source.unsplash.com/user/erondu/1600x900"
             alt="img" />
    </div>
    <div class="w-full">
        <div class="flex justify-center">
            <h2 class="text-3xl mb-10">Register</h2>
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
