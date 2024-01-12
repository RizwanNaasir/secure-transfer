@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <section id="features"
             class="container mx-auto px-4 space-y-6 bg-transparent py-8 dark:bg-transparent md:py-12 lg:py-20">

        <div class="mx-auto flex max-w-[58rem] flex-col items-center space-y-4 text-center">

            <h2 class="font-bold text-3xl leading-[1.1] sm:text-3xl md:text-6xl">About us</h2>

            <p class="max-w-[85%] leading-normal text-muted-foreground sm:text-lg sm:leading-7">
                SAFE is an American-based company operating in Fintech area in Africa that aims at eliminating payment
                risks that occur in any electronic transaction between people who don't necessarily know each other but
                are willing to conclude that transaction regardless of places they live in.
            </p>

        </div>
        <div class=" px-2 py-10">

            <div id="features" class="mx-auto max-w-8xl">
                <ul class="mt-16 grid grid-cols-1 gap-6 text-center text-slate-700 md:grid-cols-3">
                    <li class="rounded-xl bg-white px-6 py-8 shadow-sm">

                        <img src="https://www.svgrepo.com/show/530450/page-analysis.svg" alt=""
                             class="mx-auto h-10 w-10">
                        <h3 class="my-3 font-display font-medium">Mission & Vision</h3>
                        <p class="mt-1.5 text-sm leading-6 text-secondary-500 justify-center">
                            Safe positions itself as a secured and easy-used interface App for people who enter in
                            business without necessary trust in the payment process. This specific area of the mobile
                            payment system is untapped.
                            Our vision, as we innovate in the Fintech ecosystem, is to build and market
                            a reliable electronic platform that will establish trust and confidence between
                            business partners and stand the test of time.

                        </p>

                    </li>
                    <li class="rounded-xl bg-white px-6 py-8 shadow-sm">

                        <img src="https://www.svgrepo.com/show/530442/port-detection.svg"
                             alt="" class="mx-auto h-10 w-10">
                        <h3 class="my-3 font-display font-medium">Mission Statement</h3>
                        <p class="mt-1.5 text-sm leading-6 text-secondary-500">
                            Build a secure and trustworthy online transactions by addressing the lack of trust,
                            time consumption, fraud and violence against delivery companies’ agents.
                        </p>

                    </li>
                    <li class="rounded-xl bg-white px-6 py-8 shadow-sm">
                        <img src="https://www.svgrepo.com/show/530440/machine-vision.svg" alt=""
                             class="mx-auto h-10 w-10">
                        <h3 class="my-3 font-display font-medium">Leadership Team</h3>
                        <p class="mt-1.5 text-sm leading-6 text-secondary-500">
                            SAFE was founded by savvy Africans and Americans with proven expertise and experience in
                            Fintech regulation, IT landscape and community-driven Apps.
                        </p>

                    </li>
                   {{-- <li class="rounded-xl bg-white px-6 py-8 shadow-sm">
                        <a href="/pricing" class="group">
                            <img src="https://www.svgrepo.com/show/530440/machine-vision.svg" alt=""
                                 class="mx-auto h-10 w-10">
                            <h3 class="my-3 font-display font-medium group-hover:text-primary-500">Free trial</h3>
                            <p class="mt-1.5 text-sm leading-6 text-secondary-500">We offer a free trial service without
                                login. We
                                provide
                                many payment options including pay-as-you-go and subscription.</p>
                        </a>
                    </li>
                    <li class="rounded-xl bg-white px-6 py-8 shadow-sm">
                        <a href="/templates" class="group">
                            <img src="https://www.svgrepo.com/show/530450/page-analysis.svg" alt=""
                                 class="mx-auto h-10 w-10">
                            <h3 class="my-3 font-display font-medium group-hover:text-primary-500">
                                90+ templates
                            </h3>
                            <p class="mt-1.5 text-sm leading-6 text-secondary-500">We offer many templates covering
                                areas such as
                                writing,
                                education, lifestyle and creativity to inspire your potential. </p>
                        </a>
                    </li>
                    <li class="rounded-xl bg-white px-6 py-8 shadow-sm">
                        <a href="/download" class="group">
                            <img src="https://www.svgrepo.com/show/530453/mail-reception.svg" alt=""
                                 class="mx-auto h-10 w-10">
                            <h3 class="my-3 font-display font-medium group-hover:text-primary-500">Use Anywhere</h3>
                            <p class="mt-1.5 text-sm leading-6 text-secondary-500">Our product is compatible with
                                multiple platforms
                                including Web, Chrome, Windows and Mac, you can use MagickPen anywhere.</p>
                        </a>
                    </li>--}}
                </ul>
            </div>
        </div>
    </section>
@endsection
