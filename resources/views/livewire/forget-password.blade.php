<div class="flex items-center min-h-[20%]  bg-white">
    <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
        <div>
            <h1 class="text-center text-4xl my-8 font-bold">Forget Password</h1>
        </div>
        <div class="flex flex-col md:flex-row">
            <div class="h-32 md:h-auto md:w-1/2 w-[80%] ml-12 mb-6">
                <img class="object-cover w-full h-full" src="https://source.unsplash.com/user/erondu/1600x900"
                     alt="img"/>
            </div>
            <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                <div class="w-full">
                    <div class="flex justify-center">
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm">
                            Email
                        </label>
                        <input type="email"
                               class="w-full px-4 py-2 text-sm border rounded-md focus:border-blue-400 focus:outline-none focus:ring-1 focus:ring-blue-600"
                               placeholder="Email Address"/>
                    </div>
                    <button
                        class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue"
                        href="#">
                        Send Link
                    </button>

                    <div class="mt-4 text-center">
                        <p class="flex md:justify-around text-sm">Go to login page <button onclick="Livewire.emit('openModal', 'login')"
                                                               class="text-blue-600 hover:underline">
                                Sign In.</button></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
