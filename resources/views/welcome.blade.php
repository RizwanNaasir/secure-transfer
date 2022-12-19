@php use App\Models\Banner; @endphp
@php($banners = Banner::all())
@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <main>
        {{--Start Slider--}}
        <div class="relative">
            <div class="absolute inset-x-0 bottom-0 h-1/2 bg-transparent"></div>
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="relative shadow-xl sm:overflow-hidden sm:rounded-2xl">

                    <div id="default-carousel" class="relative" data-carousel="slide">
                        <!-- Carousel wrapper -->
                        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                            @forelse($banners as $banner)
                                <a href="{{$banner->link}}" target="_blank">
                                    <div
                                            class="duration-700 ease-in-out absolute inset-0 transition-all transform translate-x-0 z-0"
                                            data-carousel-item="">
                                <span
                                        class="absolute text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 sm:text-3xl dark:text-gray-800">First Slide</span>
                                        <img src="{{$banner->image_path}}"
                                             class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                             alt="{{$banner->name}}">
                                    </div>
                                </a>
                            @empty
                                <div
                                        class="duration-700 ease-in-out absolute inset-0 transition-all transform translate-x-0 z-0"
                                        data-carousel-item="">
                                <span
                                        class="absolute text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 sm:text-3xl dark:text-gray-800">First Slide</span>
                                    <img src="https://flowbite.com/docs/images/carousel/carousel-1.svg"
                                         class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                         alt="...">
                                </div>
                            @endforelse

                        </div>
                        <!-- Slider indicators -->
                        <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2 z-0">
                            @forelse($banners as $banner)
                                @php($slider = 0)
                                <button type="button" class="w-3 h-3 rounded-full bg-white dark:bg-gray-800"
                                        aria-current="true" aria-label="Slide {{$slider + 1}}" data-carousel-slide-to="{{$slider++}}"></button>
                            @empty
                                <button type="button" class="w-3 h-3 rounded-full bg-white dark:bg-gray-800"
                                        aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                            @endforelse
                        </div>
                        <!-- Slider controls -->
                        <button type="button"
                                class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none z-0"
                                data-carousel-prev="">
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                        <svg aria-hidden="true"
                                             class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                                             stroke="currentColor" viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round"
                                                                                      stroke-linejoin="round"
                                                                                      stroke-width="2"
                                                                                      d="M15 19l-7-7 7-7"></path></svg>
                                        <span class="sr-only">Previous</span>
                                    </span>
                        </button>
                        <button type="button"
                                class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none z-0"
                                data-carousel-next="">
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                        <svg aria-hidden="true"
                                             class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                                             stroke="currentColor" viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round"
                                                                                      stroke-linejoin="round"
                                                                                      stroke-width="2"
                                                                                      d="M9 5l7 7-7 7"></path></svg>
                                        <span class="sr-only">Next</span>
                                    </span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
        {{--End Slider--}}

        {{--Start Testimonial--}}
        <section class="mb-20 text-gray-700 px-12 mt-6">
            <div class="text-center md:max-w-xl lg:max-w-3xl mx-auto">
                <h3 class="text-3xl font-bold mb-6 text-gray-800">Testimonials</h3>
                <p class="mb-6 pb-2 md:mb-12 md:pb-0">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, error amet numquam
                    iure provident voluptate esse quasi, veritatis totam voluptas nostrum quisquam eum
                    porro a pariatur veniam.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6 lg:gap-12 text-center">
                <div class="mb-12 md:mb-0">
                    <div class="flex justify-center mb-6">
                        <img
                            src="https://mdbootstrap.com/img/Photos/Avatars/img%20(1).jpg"
                            class="rounded-full shadow-lg w-32"
                        />
                    </div>
                    <h5 class="text-xl font-semibold mb-4">Maria Smantha</h5>
                    <h6 class="font-semibold text-blue-600 mb-4">Web Developer</h6>
                    <p class="mb-4">
                        <svg
                            aria-hidden="true"
                            focusable="false"
                            data-prefix="fas"
                            data-icon="quote-left"
                            class="w-6 pr-2 inline-block"
                            role="img"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"
                        >
                            <path
                                fill="currentColor"
                                d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"
                            ></path>
                        </svg>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic
                        tenetur quae quaerat ad velit ab hic tenetur.
                    </p>
                    <ul class="flex justify-center mb-0">
                        <li>
                            <svg
                                aria-hidden="true"
                                focusable="false"
                                data-prefix="fas"
                                data-icon="star"
                                class="w-4 text-yellow-500"
                                role="img"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512"
                            >
                                <path
                                    fill="currentColor"
                                    d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"
                                ></path>
                            </svg>
                        </li>
                        <li>
                            <svg
                                aria-hidden="true"
                                focusable="false"
                                data-prefix="fas"
                                data-icon="star"
                                class="w-4 text-yellow-500"
                                role="img"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512"
                            >
                                <path
                                    fill="currentColor"
                                    d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"
                                ></path>
                            </svg>
                        </li>
                        <li>
                            <svg
                                aria-hidden="true"
                                focusable="false"
                                data-prefix="fas"
                                data-icon="star"
                                class="w-4 text-yellow-500"
                                role="img"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512"
                            >
                                <path
                                    fill="currentColor"
                                    d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"
                                ></path>
                            </svg>
                        </li>
                        <li>
                            <svg
                                aria-hidden="true"
                                focusable="false"
                                data-prefix="fas"
                                data-icon="star"
                                class="w-4 text-yellow-500"
                                role="img"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512"
                            >
                                <path
                                    fill="currentColor"
                                    d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"
                                ></path>
                            </svg>
                        </li>
                        <li>
                            <svg
                                aria-hidden="true"
                                focusable="false"
                                data-prefix="fas"
                                data-icon="star-half-alt"
                                class="w-4 text-yellow-500"
                                role="img"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 536 512"
                            >
                                <path
                                    fill="currentColor"
                                    d="M508.55 171.51L362.18 150.2 296.77 17.81C290.89 5.98 279.42 0 267.95 0c-11.4 0-22.79 5.9-28.69 17.81l-65.43 132.38-146.38 21.29c-26.25 3.8-36.77 36.09-17.74 54.59l105.89 103-25.06 145.48C86.98 495.33 103.57 512 122.15 512c4.93 0 10-1.17 14.87-3.75l130.95-68.68 130.94 68.7c4.86 2.55 9.92 3.71 14.83 3.71 18.6 0 35.22-16.61 31.66-37.4l-25.03-145.49 105.91-102.98c19.04-18.5 8.52-50.8-17.73-54.6zm-121.74 123.2l-18.12 17.62 4.28 24.88 19.52 113.45-102.13-53.59-22.38-11.74.03-317.19 51.03 103.29 11.18 22.63 25.01 3.64 114.23 16.63-82.65 80.38z"
                                ></path>
                            </svg>
                        </li>
                    </ul>
                </div>
                <div class="mb-12 md:mb-0">
                    <div class="flex justify-center mb-6">
                        <img
                            src="https://mdbootstrap.com/img/Photos/Avatars/img%20(2).jpg"
                            class="rounded-full shadow-lg w-32"
                        />
                    </div>
                    <h5 class="text-xl font-semibold mb-4">Lisa Cudrow</h5>
                    <h6 class="font-semibold text-blue-600 mb-4">Graphic Designer</h6>
                    <p class="mb-4">
                        <svg
                            aria-hidden="true"
                            focusable="false"
                            data-prefix="fas"
                            data-icon="quote-left"
                            class="w-6 pr-2 inline-block"
                            role="img"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"
                        >
                            <path
                                fill="currentColor"
                                d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"
                            ></path>
                        </svg>
                        Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit
                        laboriosam, nisi ut aliquid commodi.
                    </p>
                    <ul class="flex justify-center mb-0">
                        <li>
                            <svg
                                aria-hidden="true"
                                focusable="false"
                                data-prefix="fas"
                                data-icon="star"
                                class="w-4 text-yellow-500"
                                role="img"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512"
                            >
                                <path
                                    fill="currentColor"
                                    d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"
                                ></path>
                            </svg>
                        </li>
                        <li>
                            <svg
                                aria-hidden="true"
                                focusable="false"
                                data-prefix="fas"
                                data-icon="star"
                                class="w-4 text-yellow-500"
                                role="img"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512"
                            >
                                <path
                                    fill="currentColor"
                                    d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"
                                ></path>
                            </svg>
                        </li>
                        <li>
                            <svg
                                aria-hidden="true"
                                focusable="false"
                                data-prefix="fas"
                                data-icon="star"
                                class="w-4 text-yellow-500"
                                role="img"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512"
                            >
                                <path
                                    fill="currentColor"
                                    d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"
                                ></path>
                            </svg>
                        </li>
                        <li>
                            <svg
                                aria-hidden="true"
                                focusable="false"
                                data-prefix="fas"
                                data-icon="star"
                                class="w-4 text-yellow-500"
                                role="img"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512"
                            >
                                <path
                                    fill="currentColor"
                                    d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"
                                ></path>
                            </svg>
                        </li>
                        <li>
                            <svg
                                aria-hidden="true"
                                focusable="false"
                                data-prefix="fas"
                                data-icon="star"
                                class="w-4 text-yellow-500"
                                role="img"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512"
                            >
                                <path
                                    fill="currentColor"
                                    d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"
                                ></path>
                            </svg>
                        </li>
                    </ul>
                </div>
                <div class="mb-0">
                    <div class="flex justify-center mb-6">
                        <img
                            src="https://mdbootstrap.com/img/Photos/Avatars/img%20(9).jpg"
                            class="rounded-full shadow-lg w-32"
                        />
                    </div>
                    <h5 class="text-xl font-semibold mb-4">John Smith</h5>
                    <h6 class="font-semibold text-blue-600 mb-4">Marketing Specialist</h6>
                    <p class="mb-4">
                        <svg
                            aria-hidden="true"
                            focusable="false"
                            data-prefix="fas"
                            data-icon="quote-left"
                            class="w-6 pr-2 inline-block"
                            role="img"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"
                        >
                            <path
                                fill="currentColor"
                                d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"
                            ></path>
                        </svg>
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                        praesentium voluptatum deleniti atque corrupti.
                    </p>
                    <ul class="flex justify-center mb-0">
                        <li>
                            <svg
                                aria-hidden="true"
                                focusable="false"
                                data-prefix="fas"
                                data-icon="star"
                                class="w-4 text-yellow-500"
                                role="img"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512"
                            >
                                <path
                                    fill="currentColor"
                                    d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"
                                ></path>
                            </svg>
                        </li>
                        <li>
                            <svg
                                aria-hidden="true"
                                focusable="false"
                                data-prefix="fas"
                                data-icon="star"
                                class="w-4 text-yellow-500"
                                role="img"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512"
                            >
                                <path
                                    fill="currentColor"
                                    d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"
                                ></path>
                            </svg>
                        </li>
                        <li>
                            <svg
                                aria-hidden="true"
                                focusable="false"
                                data-prefix="fas"
                                data-icon="star"
                                class="w-4 text-yellow-500"
                                role="img"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512"
                            >
                                <path
                                    fill="currentColor"
                                    d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"
                                ></path>
                            </svg>
                        </li>
                        <li>
                            <svg
                                aria-hidden="true"
                                focusable="false"
                                data-prefix="fas"
                                data-icon="star"
                                class="w-4 text-yellow-500"
                                role="img"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512"
                            >
                                <path
                                    fill="currentColor"
                                    d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"
                                ></path>
                            </svg>
                        </li>
                        <li>
                            <svg
                                aria-hidden="true"
                                focusable="false"
                                data-prefix="far"
                                data-icon="star"
                                class="w-4 text-yellow-500"
                                role="img"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512"
                            >
                                <path
                                    fill="currentColor"
                                    d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z"
                                ></path>
                            </svg>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        {{--End Testimonial--}}

        {{--Start of Images of App--}}

        <section class="overflow-hidden text-gray-700">
            <div class="bg-gray-100">
                <div class="mx-auto max-w-7xl py-8 px-4 sm:px-6 lg:px-8">

                    <ul role="list"
                        class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">

                        <li class="relative">
                            <div
                                class="group aspect-w-10 aspect-h-7 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                                <img
                                    src="https://images.unsplash.com/photo-1582053433976-25c00369fc93?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=512&amp;q=80"
                                    alt="" class="pointer-events-none object-cover group-hover:opacity-75">
                                <button type="button" class="absolute inset-0 focus:outline-none">
                                    <span class="sr-only">View details for IMG_4985.HEIC</span>
                                </button>
                            </div>
                        </li>

                        <li class="relative">
                            <div
                                class="group aspect-w-10 aspect-h-7 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                                <img
                                    src="https://images.unsplash.com/photo-1614926857083-7be149266cda?ixlib=rb-1.2.1&amp;ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;auto=format&amp;fit=crop&amp;w=512&amp;q=80"
                                    alt="" class="pointer-events-none object-cover group-hover:opacity-75">
                                <button type="button" class="absolute inset-0 focus:outline-none">
                                    <span class="sr-only">View details for IMG_5214.HEIC</span>
                                </button>
                            </div>
                        </li>

                        <li class="relative">
                            <div
                                class="group aspect-w-10 aspect-h-7 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                                <img
                                    src="https://images.unsplash.com/photo-1614705827065-62c3dc488f40?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=512&amp;q=80"
                                    alt="" class="pointer-events-none object-cover group-hover:opacity-75">
                                <button type="button" class="absolute inset-0 focus:outline-none">
                                    <span class="sr-only">View details for IMG_3851.HEIC</span>
                                </button>
                            </div>
                        </li>

                        <li class="relative">
                            <div
                                class="group aspect-w-10 aspect-h-7 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                                <img
                                    src="https://images.unsplash.com/photo-1614926857083-7be149266cda?ixlib=rb-1.2.1&amp;ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;auto=format&amp;fit=crop&amp;w=512&amp;q=80"
                                    alt="" class="pointer-events-none object-cover group-hover:opacity-75">
                                <button type="button" class="absolute inset-0 focus:outline-none">
                                    <span class="sr-only">View details for IMG_5214.HEIC</span>
                                </button>
                            </div>
                        </li>

                    </ul>
                    <div class="flex justify-end mt-3">
                        <div
                            class="flex mt-3 w-48 h-14 mr-3 bg-black text-white rounded-lg items-center justify-center">
                            <div class="mr-3">
                                <svg viewBox="30 336.7 120.9 129.2" width="30">
                                    <path fill="#FFD400"
                                          d="M119.2,421.2c15.3-8.4,27-14.8,28-15.3c3.2-1.7,6.5-6.2,0-9.7  c-2.1-1.1-13.4-7.3-28-15.3l-20.1,20.2L119.2,421.2z"/>
                                    <path fill="#FF3333"
                                          d="M99.1,401.1l-64.2,64.7c1.5,0.2,3.2-0.2,5.2-1.3  c4.2-2.3,48.8-26.7,79.1-43.3L99.1,401.1L99.1,401.1z"/>
                                    <path fill="#48FF48"
                                          d="M99.1,401.1l20.1-20.2c0,0-74.6-40.7-79.1-43.1  c-1.7-1-3.6-1.3-5.3-1L99.1,401.1z"/>
                                    <path fill="#3BCCFF"
                                          d="M99.1,401.1l-64.3-64.3c-2.6,0.6-4.8,2.9-4.8,7.6  c0,7.5,0,107.5,0,113.8c0,4.3,1.7,7.4,4.9,7.7L99.1,401.1z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-xs">GET IT ON</div>
                                <div class="text-xl font-semibold font-sans -mt-1">Google Play</div>
                            </div>
                        </div>

                        <div class="flex mt-3 w-48 h-14 bg-black text-white rounded-lg items-center justify-center">
                            <div class="mr-3">
                                <svg viewBox="0 0 384 512" width="30">
                                    <path fill="currentColor"
                                          d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-xs">Download on the</div>
                                <div class="text-2xl font-semibold font-sans -mt-1">App Store</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{--End Contact us form--}}
        <section class="overflow-hidden">
            <!-- Header -->
            <div class="bg-warm-gray-50">
                <div class="py-24 lg:py-32">
                    <div class="relative z-10 mx-auto max-w-7xl pl-4 pr-8 sm:px-6 lg:px-8">
                        <h1 class="text-4xl font-bold tracking-tight text-warm-gray-900 sm:text-5xl lg:text-6xl">Sign Up
                            Now!</h1>
                        <p class="mt-6 max-w-3xl text-xl text-warm-gray-500">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Possimus magnam voluptatum
                            cupiditate veritatis in accusamus quisquam.
                    </div>
                </div>
            </div>

            <!-- Contact section -->
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
                            @livewire('auth.register-from-home')
                        </div>
                    </div>
                </div>
            </section>

            <!-- Contact grid -->
            <section aria-labelledby="offices-heading">
                <div class="mx-auto max-w-7xl py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
                    <h2 id="offices-heading" class="text-3xl font-bold tracking-tight text-warm-gray-900">Our
                        offices</h2>
                    <p class="mt-6 max-w-3xl text-lg text-warm-gray-500">Varius facilisi mauris sed sit. Non sed et duis
                        dui leo, vulputate id malesuada non. Cras aliquet purus dui laoreet diam sed lacus, fames.</p>
                    <div class="mt-10 grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-4">
                        <div>
                            <h3 class="text-lg font-medium text-warm-gray-900">Los Angeles</h3>
                            <p class="mt-2 text-base text-warm-gray-500">
                                <span class="block">4556 Brendan Ferry</span>

                                <span class="block">Los Angeles, CA 90210</span>
                            </p>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-warm-gray-900">New York</h3>
                            <p class="mt-2 text-base text-warm-gray-500">
                                <span class="block">886 Walter Streets</span>

                                <span class="block">New York, NY 12345</span>
                            </p>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-warm-gray-900">Toronto</h3>
                            <p class="mt-2 text-base text-warm-gray-500">
                                <span class="block">7363 Cynthia Pass</span>

                                <span class="block">Toronto, ON N3Y 4H8</span>
                            </p>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-warm-gray-900">London</h3>
                            <p class="mt-2 text-base text-warm-gray-500">
                                <span class="block">114 Cobble Lane</span>

                                <span class="block">London N1 2EF</span>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </section>

    </main>
    @include('layouts.footer')
@endsection
