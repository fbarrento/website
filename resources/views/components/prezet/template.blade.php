<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net" />

    <x-prezet.meta />

    <link
        rel="icon"
        href="/prezet/img/francisco.webp"
        type="image/webp"
    />
    <link rel="alternate" type="application/atom+xml" title="News" href="/feed">

    <!-- Scripts -->
    @env('production')
    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l]
            .push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})
        (window,document,'script','dataLayer','GTM-TQGPB9FN');
    </script>
    <!-- End Google Tag Manager -->
    @endenv


    <!-- Zoomable Plugin (example version) -->
    <script defer src="https://unpkg.com/@benbjurstrom/alpinejs-zoomable@0.4.0/dist/cdn.min.js"></script>
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/lite-youtube-embed@0.3.2/src/lite-yt-embed.min.js"
    ></script>
    <script
        defer
        src="https://unpkg.com/@alpinejs/ui@3.14.8/dist/cdn.min.js"
    ></script>
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.14.1/dist/cdn.min.js"
    ></script>
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"
    ></script>
    @vite(['resources/css/prezet.css'])
    @stack('jsonld')

    <script>
        ;(function () {
            const stored = localStorage.getItem('theme')
            const prefersDark = window.matchMedia(
                '(prefers-color-scheme: dark)'
            ).matches
            const useDark =
                stored === 'dark' || (stored === null && prefersDark)

            if (useDark) {
                document.documentElement.classList.add('dark')
            }
        })()
    </script>
    <title></title>
</head>
<body class="dark:bg-background-dark font-sans antialiased overscroll-none">
@env('production')
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TQGPB9FN"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
@endenv
<div class="min-h-screen">
    <x-prezet.alpine>
        <div
            class="relative text-gray-800 antialiased dark:text-gray-400"
        >

            <x-prezet.alpine>
                {{-- Alpine.js only. No layout markup added by this component --}}

                {{-- Sticky header: takes up its own space (not fixed), and aligns with main container --}}
                <header
                    class="bg-background-light/95 dark:bg-background-dark/95 supports-[backdrop-filter]:bg-background-light/75 dark:supports-[backdrop-filter]:bg-background-dark/75 sticky top-0 z-30 backdrop-blur"
                >
                    <div class="max-w-6xl mx-auto px-6 lg:px-4 xl:px-4">
                        <x-prezet.header :document="[]" />
                    </div>
                </header>

                <main class="max-w-6xl relative mx-auto px-6 lg:px-4 xl:px-4">
                    {{ $slot }}
                </main>

                {{-- Search Modal - positioned at root level for full viewport overlay --}}
                <div
                    x-cloak
                    x-show="searchOpen"
                    x-trap.inert.noscroll="searchOpen"
                    x-transition:enter="transition duration-300 ease-out"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition duration-200 ease-in"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    x-bind:aria-hidden="!searchOpen"
                    x-on:keydown.esc.prevent.stop="closeCommandPalette()"
                    class="z-90 fixed inset-0 overflow-y-auto overflow-x-hidden bg-zinc-900/75 p-4 backdrop-blur-xs will-change-auto md:py-8 lg:px-8 lg:py-16"
                    tabindex="-1"
                    role="dialog"
                    aria-modal="true"
                >
                    <x-prezet.search-modal-dialog />
                </div>
                {{-- END Search Modal --}}
            </x-prezet.alpine>
        </div>
    </x-prezet.alpine>
</div>
</body>
</html>
