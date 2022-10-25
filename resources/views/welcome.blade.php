@extends('layouts.app')
@section('content')
@include('layouts.header')
<main>
        {{--Start Slider--}}
        <div class="relative">
            <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gray-100"></div>
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="relative shadow-xl sm:overflow-hidden sm:rounded-2xl">

                    <div id="default-carousel" class="relative" data-carousel="slide">
                        <!-- Carousel wrapper -->
                        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                            <!-- Item 1 -->
                            <div
                                class="duration-700 ease-in-out absolute inset-0 transition-all transform translate-x-0 z-20"
                                data-carousel-item="">
                                <span
                                    class="absolute text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 sm:text-3xl dark:text-gray-800">First Slide</span>
                                <img src="https://flowbite.com/docs/images/carousel/carousel-1.svg"
                                     class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                     alt="...">
                            </div>
                            <!-- Item 2 -->
                            <div
                                class="duration-700 ease-in-out absolute inset-0 transition-all transform translate-x-full z-10"
                                data-carousel-item="">
                                <img src="https://flowbite.com/docs/images/carousel/carousel-1.svg"
                                     class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                     alt="...">
                            </div>
                            <!-- Item 3 -->
                            <div
                                class="duration-700 ease-in-out absolute inset-0 transition-all transform -translate-x-full z-10"
                                data-carousel-item="">
                                <img src="https://flowbite.com/docs/images/carousel/carousel-1.svg"
                                     class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                     alt="...">
                            </div>
                        </div>
                        <!-- Slider indicators -->
                        <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
                            <button type="button" class="w-3 h-3 rounded-full bg-white dark:bg-gray-800"
                                    aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                            <button type="button"
                                    class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800"
                                    aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                            <button type="button"
                                    class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800"
                                    aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                        </div>
                        <!-- Slider controls -->
                        <button type="button"
                                class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
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
                                class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
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
            <div class="container px-5 pl-0 pr-0 pt-6 pb-2 pb-6rem mx-auto lg:pt-12 lg:px-32 bg-gray-200 rounded-lg">
                <div class="flex flex-wrap -m-1 md:-m-2 flex-none w-full h-[23.625rem] max-w-full sm:ml-auto">
                    <div class="flex flex-wrap w-1/6">
                        <div class="w-full p-1 md:p-2">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp">
                        </div>
                    </div>
                    <div class="flex flex-wrap w-1/6">
                        <div class="w-full p-1 md:p-2">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(74).webp">
                        </div>
                    </div>
                    <div class="flex flex-wrap w-1/6">
                        <div class="w-full p-1 md:p-2">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(75).webp">
                        </div>
                    </div>
                    <div class="flex flex-wrap w-1/6">
                        <div class="w-full p-1 md:p-2">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(70).webp">
                        </div>
                    </div>
                    <div class="flex flex-wrap w-1/6">
                        <div class="w-full p-1 md:p-2">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(76).webp">
                        </div>
                    </div>
                    <div class="flex flex-wrap w-1/6">
                        <div class="w-full p-1 md:p-2">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(72).webp">
                        </div>
                    </div>
                </div>
                <div class="flex justify-end">
                    <div class="flex mt-3 w-48 h-14 mr-3 bg-black text-white rounded-lg items-center justify-center">
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

                    <div class="flex mt-3 w-48 h-14 bg-black text-white rounded-xl items-center justify-center">
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
        </section>
        {{--End of Images of App--}}

        {{--Start Contact us form--}}
        <div class="flex items-center min-h-[20%]  bg-gray-50">
            <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
                <div class="">
                    <h1 class="text-center text-4xl my-8 font-bold">Contact Us</h1>
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
                                href="#">
                                Submit
                            </button>

                            <div class="mt-4 text-center">
                                <p class="text-sm">Don't have an account yet? <a href="#"
                                                                                 class="text-blue-600 hover:underline">
                                        Sign up.</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--End Contact us form--}}
    </main>
@include('layouts.footer')
<script>
        const items = [
            {
                position: 0,
                el: document.getElementById('carousel-item-1')
            },
            {
                position: 1,
                el: document.getElementById('carousel-item-2')
            },
            {
                position: 2,
                el: document.getElementById('carousel-item-3')
            },
            {
                position: 3,
                el: document.getElementById('carousel-item-4')
            },
        ];

        const options = {
            activeItemPosition: 1,
            interval: 3000,

            indicators: {
                activeClasses: 'bg-white dark:bg-gray-800',
                inactiveClasses: 'bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800',
                items: [
                    {
                        position: 0,
                        el: document.getElementById('carousel-indicator-1')
                    },
                    {
                        position: 1,
                        el: document.getElementById('carousel-indicator-2')
                    },
                    {
                        position: 2,
                        el: document.getElementById('carousel-indicator-3')
                    },
                    {
                        position: 3,
                        el: document.getElementById('carousel-indicator-4')
                    },
                ]
            },

            // callback functions
            onNext: () => {
                console.log('next slider item is shown');
            },
            onPrev: () => {
                console.log('previous slider item is shown');
            },
            onChange: () => {
                console.log('new slider item has been shown');
            }
        };
        const carousel = new Carousel(items, options);
        const prevButton = document.getElementById('data-carousel-prev');
        const nextButton = document.getElementById('data-carousel-next');

        prevButton.addEventListener('click', () => {
            carousel.prev();
        });

        nextButton.addEventListener('click', () => {
            carousel.next();
        });

    </script>
@endsection
