<div class="relative">
    <div class="md-mx-3 flex h-16 min-w-0 items-center">
        <div
            class="relative flex h-full min-w-0 flex-1 items-center gap-x-4 border-b border-gray-500/5 dark:border-gray-300/[0.06]"
        >
            <div class="flex flex-1 items-center gap-x-4">
                <a class="" href="/">
                    <span class="sr-only">{{ config('app.name') }} home page</span>
                    <div class="flex items-center gap-2 text-2xl tracking-tight">
                        <span class="font-semibold text-gray-900 dark:text-white">
                            {{ config('app.name') }}
                        </span>
                    </div>
                </a>
                <div class="hidden items-center gap-x-2 lg:flex"></div>
            </div>
            <div class="relative hidden flex-1 items-center justify-center lg:flex">
                <button
                    type="button"
                    x-on:click="openCommandPalette()"
                    class="bg-background-light dark:bg-background-dark pointer-events-auto flex h-9 w-full min-w-[43px] items-center justify-between gap-2 truncate rounded-xl pr-3 pl-3.5 text-sm leading-6 text-gray-500 ring-1 ring-gray-400/30 hover:ring-gray-600/30 dark:text-white/50 dark:ring-1 dark:ring-gray-600/30 dark:brightness-[1.1] dark:hover:ring-gray-500/30 dark:hover:brightness-[1.25]"
                    aria-label="Open search"
                >
                    <div class="flex min-w-[42px] items-center gap-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-search min-w-4 flex-none text-gray-700 hover:text-gray-800 dark:text-gray-400 hover:dark:text-gray-200"
                        >
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </svg>
                        <div class="min-w-0 truncate">Search...</div>
                    </div>
                    <span class="flex-none text-xs font-semibold">
                        <span x-text="searchModifierKey"></span>
                        K
                    </span>
                </button>
            </div>
            <div class="relative ml-auto flex flex-1 items-center justify-end gap-3">
                <a
                    href="{{ route('prezet.index') }}"
                    class="navbar-link hidden items-center gap-1.5 text-sm font-medium whitespace-nowrap text-gray-600 hover:text-gray-900 lg:flex dark:text-gray-400 dark:hover:text-gray-300"
                    target="_blank"
                >
                    Blog
                </a>

                <button
                    type="button"
                    x-on:click="openCommandPalette()"
                    class="flex h-8 w-8 items-center justify-center text-gray-500 hover:text-gray-600 lg:hidden dark:text-gray-400 dark:hover:text-gray-300"
                    aria-label="Open search"
                >
                    <span class="sr-only">Search...</span>
                    <svg
                        class="size-5 fill-gray-500 hover:fill-gray-600 dark:fill-gray-400 dark:hover:fill-gray-300"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 640 640"
                    >
                        <!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                        <path
                            d="M480 272C480 317.9 465.1 360.3 440 394.7L566.6 521.4C579.1 533.9 579.1 554.2 566.6 566.7C554.1 579.2 533.8 579.2 521.3 566.7L394.7 440C360.3 465.1 317.9 480 272 480C157.1 480 64 386.9 64 272C64 157.1 157.1 64 272 64C386.9 64 480 157.1 480 272zM272 416C351.5 416 416 351.5 416 272C416 192.5 351.5 128 272 128C192.5 128 128 192.5 128 272C128 351.5 192.5 416 272 416z"
                        />
                    </svg>
                </button>
                <x-prezet.dark-mode-toggle />
            </div>
        </div>
    </div>
</div>
