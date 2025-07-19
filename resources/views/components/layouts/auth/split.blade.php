<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
            <div class="bg-muted relative hidden h-full flex-col p-10 text-white lg:flex dark:border-r dark:border-neutral-800">
                <div class="absolute inset-0 bg-neutral-900"></div>
                <a href="{{ route('home') }}" class="relative z-20 flex items-center text-lg font-medium" wire:navigate>
                    <span class="flex h-10 w-10 items-center justify-center rounded-md">
                        <x-app-logo-icon class="mr-2 h-7 fill-current text-white" />
                    </span>
                    {{ config('app.name', 'Laravel') }}
                </a>

                @php
                    [$message, $author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
                @endphp

                <div class="relative flex flex-1 items-center justify-center z-10">
                    <!-- Glowing blurred background -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-80 h-80 bg-gradient-to-tr from-blue-500 via-purple-500 to-pink-500 opacity-40 blur-3xl rounded-full animate-pulse"></div>
                    </div>
                    <div class="relative text-center">
                        <h1 class="text-6xl md:text-7xl font-extrabold bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 bg-clip-text text-transparent drop-shadow-xl animate-glow">
                            Welcome to our app
                        </h1>
                        <p class="mt-4 text-lg md:text-2xl text-white/80 font-medium animate-fade-in">
                            Empowering student attendance, simply and beautifully.
                        </p>
                    </div>
                </div>

                <style>
                @keyframes glow {
                  0%, 100% { text-shadow: 0 0 20px #a78bfa, 0 0 40px #f472b6; }
                  50% { text-shadow: 0 0 40px #60a5fa, 0 0 80px #a78bfa; }
                }
                .animate-glow {
                  animation: glow 2.5s ease-in-out infinite alternate;
                }
                @keyframes fade-in {
                  from { opacity: 0; transform: translateY(20px); }
                  to { opacity: 1; transform: none; }
                }
                .animate-fade-in {
                  animation: fade-in 1.2s ease 0.5s both;
                }
                </style>

                <div class="relative z-20 mt-auto">
                    <blockquote class="space-y-2">
                        <flux:heading size="lg">&ldquo;{{ trim($message) }}&rdquo;</flux:heading>
                        <footer><flux:heading>{{ trim($author) }}</flux:heading></footer>
                    </blockquote>
                </div>
            </div>
            <div class="w-full lg:p-8">
                <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                    <a href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden" wire:navigate>
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
    </body>
</html>