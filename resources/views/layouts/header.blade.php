@php use App\Models\User;use Filament\Facades\Filament;
$currentPanel = auth()->check() && auth()->user()->isAdmin() ? 'admin' : 'panel';
@endphp
<style>
    [x-cloak] { display: none !important; }
</style>
<header>
    <div class="relative bg-white">
        <div
            class="mx-auto flex max-w-7xl items-center justify-between px-4 py-6 sm:px-6 md:justify-start md:space-x-10 lg:px-8">
            <div class="flex justify-start lg:w-0 lg:flex-1">
                <a href="{{url('/')}}">
                    <span class="sr-only">Your Company</span>
                    <x-application-logo class="h-8 w-auto sm:h-10"/>
                </a>
            </div>
            <div class="mt-5 ml-16" x-data="{mobileDropdown: false}" >
                <button @click="mobileDropdown = !mobileDropdown" class="lg:hidden whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"
                        id="btn">
                    <span class="mr-2">{{ Config::get('languages')[App::getLocale()]['display'] }}</span>

                    @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())

                            <div id="drop"
                                 :class="{hidden : !mobileDropdown}" x-show="open"
                                 class="hidden absolute w-60 px-5 py-3 dark:bg-gray-800 bg-white rounded-lg shadow border dark:border-transparent mt-5"
                                 style="left: 30%; top: 65px;z-index: 1;width: 27%"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 >
                                <ul class="space-y-3" x-cloak>
                                    <li class="font-medium" >
                                        <a href="{{ route('lang.switch', $lang) }}"
                                           class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700 lg:block whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
                                          {{--  <div class="mr-3">
                                                <span class="flag-icon flag-icon-{{$language['flag-icon']}}"></span>
                                            </div>--}}
                                            {{--Dashboard--}}
                                            {{--                                            {{__('lang.dashboard')}}--}}
                                            {{$language['display']}}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    @endforeach
                </button>
            </div>
            <div class="items-center justify-end md:flex md:flex-1 lg:w-0 gap-8 md:gap-4">
                <a href="{{url('/')}}"
                   class="hidden lg:block whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
                    {{--Home--}}
                    <span class="mr-4">{{__('lang.home')}}</span> <span class="lg:ml-4 lg:border-r-2"></span>
                </a>
                <a href="{{route('about-us')}}"
                   class="hidden lg:block whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
                    {{--About--}}
                    <span class="mr-4">{{__('lang.about')}}</span> <span class="lg:ml-4 lg:border-r-2"></span>
                </a>
                @auth
                    <a href="{{url($currentPanel.'/contracts/create')}}"
                       class="hidden lg:block whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
                        {{--Add New Contract--}}
                        <span class="mr-4">{{__('lang.add_new_contract')}}</span> <span class="ml-4 border-r-2"></span>
                    </a>
                    <a href="{{url($currentPanel.'/contracts')}}"
                       class="hidden lg:block whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
                        {{--History--}}
                        <span class="mr-4">{{__('lang.contracts')}}</span><span class="ml-4 border-r-2"></span>
                    </a>
                @endauth
                <a href="{{route('all.products')}}"
                   class="hidden lg:block">
                    {{--Market Place--}}
                    <span
                        class="mr-4 whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"> {{__('lang.market_place')}}</span>
                    <span class="ml-4 border-r-2"></span>
                </a>

                <div class="flex justify-center items-center">
                    <div x-data="{ open: false, dropdown: false  }" class=" flex justify-center items-center z-50">
                        <div @click="open = !open" class="relative py-3"
                             :class="{'border-indigo-700 transform transition duration-300 ': open}"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100">
                            <div class="hidden lg:block flex justify-center items-center space-x-3 cursor-pointer">
                                <a href="#" @click="dropdown = !dropdown"
                                   class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
                                    {{--<span
                                        class=" lg:block whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900 flag-icon flag-icon-{{Config::get('languages')[App::getLocale()]['flag-icon']}}">
                                    </span>--}}
                                    <span
                                        class="mr-6">{{ Config::get('languages')[App::getLocale()]['display'] }}</span><span
                                        class="ml-4 border-r-2">
                                    </span>
                                </a>
                            </div>

                            @foreach (Config::get('languages') as $lang => $language)
                                @if ($lang != App::getLocale())

                                    <div
                                        :class="{hidden : !dropdown}"
                                        class="hidden absolute w-60 px-5 py-3 dark:bg-gray-800 bg-white rounded-lg shadow border dark:border-transparent mt-5"
                                        x-show="open" style="left: -212px; top: 65px;"
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="transform opacity-0 scale-95"
                                         x-transition:enter-end="transform opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="transform opacity-100 scale-100"
                                         x-transition:leave-end="transform opacity-0 scale-95"
                                         >
                                        <ul class="space-y-3">
                                            <li class="font-medium">
                                                <a href="{{ route('lang.switch', $lang) }}"
                                                   class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700 lg:block whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
                                                    <div class="mr-3">
                                                        <span
                                                            class="flag-icon flag-icon-{{$language['flag-icon']}}"></span>
                                                    </div>
                                                    {{--Dashboard--}}
                                                    {{--                                            {{__('lang.dashboard')}}--}}
                                                    {{$language['display']}}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
                @guest
                    <button
                        class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900 mr-1"
                        onclick="window.location.href='{{url($currentPanel.'/login')}}'">
                        {{--Login--}}
                        {{__('lang.login')}}
                    </button>
                    <button
                        class="inline-flex items-center rounded-md border border-transparent bg-purple-100 px-3 py-2 text-sm font-medium leading-4 text-purple-700 hover:bg-purple-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2"
                        onclick="window.location.href='{{url($currentPanel.'/register')}}'">
                        {{--Sign Up--}}
                        {{__('lang.sign_up')}}
                    </button>

                @endguest
                @auth
                    <div class="flex justify-center items-center">
                        <div x-data="{ open: false , dashboard :false }" class=" flex justify-center items-center z-50">
                            <div @click="open = !open" class="relative py-3"
                                 :class="{'border-indigo-700 transform transition duration-300 ': open}"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100">
                                <div class="flex justify-center items-center space-x-3 cursor-pointer">
                                    <div

                                        class="w-12 h-12 rounded-full overflow-hidden border-2 dark:border-white border-gray-900">
                                        <img @click="dashboard = !dashboard" src="{{auth()->user()->getFirstMediaUrl(User::AVATAR_COLLECTION)}}"
                                             alt=""
                                             onerror="this.src='{{asset('assets/images/avatar.png')}}'"
                                             class="w-full h-full object-cover">
                                    </div>
                                </div>
                                <div x-show="open" style="left: -212px; top: 65px;"
                                     class="hidden absolute w-60 px-5 py-3 dark:bg-gray-800 bg-white rounded-lg shadow border dark:border-transparent mt-5"
                                     :class="{hidden : !dashboard}"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     >
                                    <ul class="space-y-3">
                                        <li class="font-medium">
                                            <a href="{{url($currentPanel)}}"
                                               class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700">
                                                <div class="mr-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                </div>
                                                {{--Dashboard--}}
                                                {{__('lang.dashboard')}}
                                            </a>
                                        </li>
                                        <li class="font-medium">
                                            <a href="{{url($currentPanel.'/users/'.auth()->id().'/edit')}}"
                                               class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700">
                                                <div class="mr-3">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>
                                                </div>
                                                {{--Edit Profile--}}
                                                {{__('lang.edit_profile')}}
                                            </a>
                                        </li>
                                        <li class="block lg:hidden font-medium">
                                            <button onclick="window.location.href='{{url($currentPanel.'/contract')}}'"
                                                    class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700">
                                                <div class="mr-3">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                </div>
                                                {{--Add new Contact--}}
                                                {{__('lang.add_new_contract')}}
                                            </button>
                                        </li>
                                        <li class="block lg:hidden font-medium">
                                            <button onclick="location.href='{{url($currentPanel.'/contract')}}'"
                                                    class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700">
                                                <div class="mr-3">
                                                    <svg width="21px" height="18px" viewBox="0 0 21 18" version="1.1"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <!-- Generator: Sketch 52.5 (67469) - http://www.bohemiancoding.com/sketch -->
                                                        <title>
                                                            {{--history--}}
                                                            {{__('lang.contracts')}}
                                                        </title>
                                                        <desc>{{__('lang.created_with_sketch')}}.</desc>
                                                        <g id="Icons" stroke="none" stroke-width="1" fill="none"
                                                           fill-rule="evenodd">
                                                            <g id="Rounded"
                                                               transform="translate(-441.000000, -289.000000)">
                                                                <g id="Action"
                                                                   transform="translate(100.000000, 100.000000)">
                                                                    <g id="-Round-/-Action-/-history"
                                                                       transform="translate(340.000000, 186.000000)">
                                                                        <g transform="translate(0.000000, 0.000000)">
                                                                            <polygon id="Path"
                                                                                     points="0 0 24 0 24 24 0 24"></polygon>
                                                                            <path
                                                                                d="M13.26,3 C8.17,2.86 4,6.95 4,12 L2.21,12 C1.76,12 1.54,12.54 1.86,12.85 L4.65,15.65 C4.85,15.85 5.16,15.85 5.36,15.65 L8.15,12.85 C8.46,12.54 8.24,12 7.79,12 L6,12 C6,8.1 9.18,4.95 13.1,5 C16.82,5.05 19.95,8.18 20,11.9 C20.05,15.81 16.9,19 13,19 C11.39,19 9.9,18.45 8.72,17.52 C8.32,17.21 7.76,17.24 7.4,17.6 C6.98,18.02 7.01,18.73 7.48,19.09 C9,20.29 10.91,21 13,21 C18.05,21 22.14,16.83 22,11.74 C21.87,7.05 17.95,3.13 13.26,3 Z M12.75,8 C12.34,8 12,8.34 12,8.75 L12,12.43 C12,12.78 12.19,13.11 12.49,13.29 L15.61,15.14 C15.97,15.35 16.43,15.23 16.64,14.88 C16.85,14.52 16.73,14.06 16.38,13.85 L13.5,12.14 L13.5,8.74 C13.5,8.34 13.16,8 12.75,8 Z"
                                                                                id="🔹Icon-Color" fill="#1D1D1D"></path>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </div>
                                                History
                                            </button>
                                        </li>
                                        <li class="font-medium">
                                            <button onclick="location.href='{{url($currentPanel.'/products')}}'"
                                                    class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700">
                                                <div class="mr-3">
                                                    <svg width="21px" height="18px" viewBox="0 0 21 18" version="1.1"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <!-- Generator: Sketch 52.5 (67469) - http://www.bohemiancoding.com/sketch -->
                                                        <title>
                                                            {{__('lang.products')}}
                                                        </title>
                                                        <desc>{{__('lang.my-products')}}.</desc>
                                                        <g id="Icons" stroke="none" stroke-width="1" fill="none"
                                                           fill-rule="evenodd">
                                                            <g id="Rounded"
                                                               transform="translate(-441.000000, -289.000000)">
                                                                <g id="Action"
                                                                   transform="translate(100.000000, 100.000000)">
                                                                    <g id="-Round-/-Action-/-history"
                                                                       transform="translate(340.000000, 186.000000)">
                                                                        <g transform="translate(0.000000, 0.000000)">
                                                                            <polygon id="Path"
                                                                                     points="0 0 24 0 24 24 0 24"></polygon>
                                                                            <path
                                                                                d="M13.26,3 C8.17,2.86 4,6.95 4,12 L2.21,12 C1.76,12 1.54,12.54 1.86,12.85 L4.65,15.65 C4.85,15.85 5.16,15.85 5.36,15.65 L8.15,12.85 C8.46,12.54 8.24,12 7.79,12 L6,12 C6,8.1 9.18,4.95 13.1,5 C16.82,5.05 19.95,8.18 20,11.9 C20.05,15.81 16.9,19 13,19 C11.39,19 9.9,18.45 8.72,17.52 C8.32,17.21 7.76,17.24 7.4,17.6 C6.98,18.02 7.01,18.73 7.48,19.09 C9,20.29 10.91,21 13,21 C18.05,21 22.14,16.83 22,11.74 C21.87,7.05 17.95,3.13 13.26,3 Z M12.75,8 C12.34,8 12,8.34 12,8.75 L12,12.43 C12,12.78 12.19,13.11 12.49,13.29 L15.61,15.14 C15.97,15.35 16.43,15.23 16.64,14.88 C16.85,14.52 16.73,14.06 16.38,13.85 L13.5,12.14 L13.5,8.74 C13.5,8.34 13.16,8 12.75,8 Z"
                                                                                id="🔹Icon-Color" fill="#1D1D1D"></path>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </div>
                                                {{__('lang.products')}}
                                            </button>
                                        </li>
                                        <hr class="dark:border-gray-700">
                                        <li class="font-medium">
                                            <form method="post" action="{{route('logout')}}">
                                                @csrf
                                                <button type="submit"
                                                        class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-red-600">
                                                    <div class="mr-3 text-red-600">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                                        </svg>
                                                    </div>
                                                    {{--Logout--}}
                                                    {{__('lang.logout')}}
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>

        </div>
    </div>
</header>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {

        $("#drop").hide();

        $("#btn").click(function () {

            $("#drop").toggle();

        });

    });
</script>
