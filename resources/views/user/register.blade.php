@extends('layouts.app')
@section('content')
    @include('layouts.header')
<section class="relative bg-white" aria-labelledby="contact-heading">
    <div class="absolute h-1/2 w-full bg-warm-gray-50" aria-hidden="true"></div>
    <!-- Decorative dot pattern -->
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <svg
            class="absolute top-0 right-0 z-0 -translate-y-16 translate-x-1/2 transform sm:translate-x-1/4 md:-translate-y-24 lg:-translate-y-72"
            width="404" height="384" fill="none" viewBox="0 0 404 384" aria-hidden="true">
            <defs>
                <pattern id="64e643ad-2176-4f86-b3d7-f2c5da3b6a6d" x="0" y="0" width="20" height="20"
                         patternUnits="userSpaceOnUse">
                    <rect x="0" y="0" width="4" height="4" class="text-warm-gray-200" fill="currentColor"/>
                </pattern>
            </defs>
            <rect width="404" height="384" fill="url(#64e643ad-2176-4f86-b3d7-f2c5da3b6a6d)"/>
        </svg>
    </div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="relative bg-white shadow-xl">
            <h2 id="contact-heading" class="sr-only">Register Right Now</h2>

            <div class="grid grid-cols-2 lg:grid-cols-3">
                <!-- Contact information -->
                <div
                    class="hidden lg:block md:block sm:block relative overflow-hidden bg-gradient-to-b from-teal-500 to-teal-600 py-10 px-6 sm:px-10 xl:p-12">
                    <!-- Decorative angle backgrounds -->
                    <div class="pointer-events-none absolute inset-0 sm:hidden" aria-hidden="true">
                        <svg class="absolute inset-0 h-full w-full" width="343" height="388"
                             viewBox="0 0 343 388" fill="none" preserveAspectRatio="xMidYMid slice"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M-99 461.107L608.107-246l707.103 707.107-707.103 707.103L-99 461.107z"
                                  fill="url(#linear1)" fill-opacity=".1"/>
                            <defs>
                                <linearGradient id="linear1" x1="254.553" y1="107.554" x2="961.66"
                                                y2="814.66" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#fff"></stop>
                                    <stop offset="1" stop-color="#fff" stop-opacity="0"></stop>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <div
                        class="pointer-events-none absolute top-0 right-0 bottom-0 hidden w-1/2 sm:block lg:hidden"
                        aria-hidden="true">
                        <svg class="absolute inset-0 h-full w-full" width="359" height="339"
                             viewBox="0 0 359 339" fill="none" preserveAspectRatio="xMidYMid slice"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M-161 382.107L546.107-325l707.103 707.107-707.103 707.103L-161 382.107z"
                                fill="url(#linear2)" fill-opacity=".1"/>
                            <defs>
                                <linearGradient id="linear2" x1="192.553" y1="28.553" x2="899.66"
                                                y2="735.66" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#fff"></stop>
                                    <stop offset="1" stop-color="#fff" stop-opacity="0"></stop>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <div class="pointer-events-none absolute top-0 right-0 bottom-0 hidden w-1/2 lg:block"
                         aria-hidden="true">
                        <svg class="absolute inset-0 h-full w-full" width="160" height="678"
                             viewBox="0 0 160 678" fill="none" preserveAspectRatio="xMidYMid slice"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M-161 679.107L546.107-28l707.103 707.107-707.103 707.103L-161 679.107z"
                                  fill="url(#linear3)" fill-opacity=".1"/>
                            <defs>
                                <linearGradient id="linear3" x1="192.553" y1="325.553" x2="899.66"
                                                y2="1032.66" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#fff"></stop>
                                    <stop offset="1" stop-color="#fff" stop-opacity="0"></stop>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-white">Sign up Righ now</h3>
                    <p class="mt-6 max-w-3xl text-base text-teal-50">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa libero labore natus,
                        quod, quas, voluptatem quia voluptates quibusdam voluptatibus necessitatibus.
                    <dl class="mt-8 space-y-6">
                        <div>
                            <dt class="sr-only">Phone number</dt>
                            <dd class="flex">
                                <svg class="flex-shrink-0 h-6 w-6 text-teal-400"
                                     x-description="Heroicon name: outline/phone"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 3a2 2 0 012 2v10a2 2 0 01-2 2H9a2 2 0 01-2-2V5a2 2 0 012-2h6zm3 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span class="ml-3 text-base text-teal-50">
                                                +1 (555) 123-4567
                                            </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="sr-only">Email</dt>
                            <dd class="flex">
                                <svg class="flex-shrink-0 h-6 w-6 text-teal-400"
                                     x-description="Heroicon name: outline/mail"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 7l7 5 7-5M5 21v-8a2 2 0 012-2h10a2 2 0 012 2v8m-10-6l-7 5m14 0l7-5"/>
                                </svg>
                                <span
                                    class="ml-3 text-base text-teal-50">{{config('mail.from.address')}}</span>
                            </dd>
                        </div>
                    </dl>
                    <ul role="list" class="mt-8 flex space-x-12">
                        <li>
                            <a class="text-teal-200 hover:text-teal-100" href="#">
                                <span class="sr-only">Facebook</span>
                                <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24"
                                     aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a class="text-teal-200 hover:text-teal-100" href="#">
                                <span class="sr-only">GitHub</span>
                                <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24"
                                     aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a class="text-teal-200 hover:text-teal-100" href="#">
                                <span class="sr-only">Twitter</span>
                                <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24"
                                     aria-hidden="true">
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Register form -->
                @livewire('register-from-home',['tempUser' => $tempUser])
            </div>
        </div>
    </div>
</section>
@endsection
