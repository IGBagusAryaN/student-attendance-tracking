<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
    <div
        class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
        <div
            class="bg-muted relative hidden h-full flex-col p-10 text-white lg:flex dark:border-e dark:border-neutral-800">
            <div class="absolute inset-0 bg-[#f9f9f9] dark:bg-[#1d1d1d]"></div>

            <a href="{{ route('login') }}" class="relative z-20 flex items-center text-lg text-[#1d1d1d] dark:text-white font-semibold" wire:navigate>
                <span class="flex h-10 w-10 items-center justify-center rounded-md">
                    <x-app-logo-icon class="me-2 h-7 fill-current text-[#1d1d1d] dark:text-white" />
                </span>
                {{ config('app.name', 'Laravel') }}
            </a>
            <div class="relative z-10 flex flex-1 items-center justify-center">
                <x-lottie.animation-auth />

            </div>
            <div class="swiper w-full h-24 flex items-center justify-center text-center text-[#1d1d1d] dark:text-white">
                <div class="swiper-wrapper w-full">
                    <div class="swiper-slide flex items-center justify-center h-full text-center px-4">
                        “Every presence today is a step toward a brighter future.”
                    </div>
                    <div class="swiper-slide flex items-center justify-center h-full text-center px-4">
                        “Teaching is not just about delivering material, but also about building discipline.”
                    </div>
                    <div class="swiper-slide flex items-center justify-center h-full text-center px-4">
                        “Attendance is the beginning of every meaningful learning process.”
                    </div>
                </div>
                <div class="swiper-pagination mt-4"></div>
            </div>

        </div>


        <div class="w-full lg:p-8">
            <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                <a href="{{ route('login') }}" class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden"
                    wire:navigate>
                    <span class="flex h-9 w-9 items-center justify-center rounded-md">
                        <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
                    </span>

                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                </a>
                {{ $slot }}
            </div>
        </div>
    </div>
    @fluxScripts
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper', {
            loop: true,
            autoplay: {
                delay: 3000,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>
</body>

</html>
