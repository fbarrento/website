@php
    /**
     * @var string $title
     * @var string $tagline
     * @var array<int, array{label: string, heading: string, description: string, features?: array<int, array{title: string, description: string}>}> $layers
     * @var array<int, array{title: string, description: string}> $highlights
     * @var array<int, string> $audiences
     * @var string $footerNote
     * @var string $theme
     * @var string $backgroundHorizontal
     */
@endphp
<x-images-layout>
@push('styles')
    <style>
        :root {
            color-scheme: dark;
        }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            width: 1200px;
            height: 675px;
            display: flex;
            align-items: stretch;
        }

        .gradient-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.4;
            pointer-events: none;
        }

        .gradient-orb-1 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.4) 0%, rgba(59, 130, 246, 0.3) 50%, transparent 100%);
            top: -100px;
            right: -50px;
        }

        .gradient-orb-2 {
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(236, 72, 153, 0.35) 0%, rgba(139, 92, 246, 0.25) 50%, transparent 100%);
            bottom: -80px;
            left: -30px;
        }

        .gradient-orb-3 {
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.3) 0%, rgba(236, 72, 153, 0.2) 50%, transparent 100%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .layer-card {
            box-shadow: 0 8px 32px rgba(139, 92, 246, 0.3), 0 4px 16px rgba(59, 130, 246, 0.2), 0 2px 8px rgba(236, 72, 153, 0.15);
        }

        .feature-card {
            box-shadow: 0 6px 24px rgba(139, 92, 246, 0.25), 0 3px 12px rgba(59, 130, 246, 0.15), 0 1px 6px rgba(236, 72, 153, 0.1);
        }

        .audience-pill {
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2), 0 2px 6px rgba(59, 130, 246, 0.15);
        }

        h1 {
            text-shadow: 0 2px 8px rgba(139, 92, 246, 0.3), 0 1px 4px rgba(59, 130, 246, 0.2);
        }

        .layer-heading {
            text-shadow: 0 2px 8px rgba(139, 92, 246, 0.25), 0 1px 4px rgba(59, 130, 246, 0.15);
        }

        .feature-title {
            text-shadow: 0 1px 4px rgba(139, 92, 246, 0.2);
        }
    </style>
@endpush

    <div class="flex items-center justify-center w-full h-full relative bg-linear-to-b from-indigo-900 to-indigo-950">
        <div class="p-8 mx-auto">
            <div class="flex flex-col justify-between relative z-10">
                <header class="flex justify-start mb-5">
                    <h1 class="m-0 text-[28px] leading-tight font-medium text-white">
                        Laravel Cloud SDK Architecture at a glance.
                    </h1>
                </header>

                <main class="flex flex-col gap-5">
                    @foreach($layers as $layer)
                        <div class="rounded-xl bg-white/10 p-5 px-7 flex flex-col gap-4 relative">
                            <div class="flex flex-col gap-2">
                                <p class="m-0 text-[9px] tracking-[0.3em] uppercase text-white">
                                    {{ $layer['label'] }}
                                </p>
                                <h2 class="m-0 text-[28px] font-semibold text-white">
                                    {{ $layer['heading'] }}
                                </h2>
                            </div>
                            @if(!empty($layer['features'] ?? []))
                                <div class="mt-0 grid gap-3 grid-cols-4 flex-1">
                                    @foreach($layer['features'] as $feature)
                                        <div class="rounded-lg bg-white/10 p-4 px-5 flex flex-col items-start justify-start gap-2.5 min-h-[60px] relative">
                                            <div class="flex items-center gap-2.5">
                                                @if(!empty($feature['icon'] ?? null))
                                                    <div class="w-5 h-5 shrink-0 text-white/90">
                                                        <x-icon name="lucide-{{ $feature['icon'] }}" class="w-full h-full fill-none stroke-current stroke-2 [stroke-linecap:round] [stroke-linejoin:round]" />
                                                    </div>
                                                @endif
                                                <p class="feature-title m-0 text-[15px] font-semibold text-white leading-tight text-left">
                                                    {{ $feature['title'] }}
                                                </p>
                                            </div>
                                            @if(!empty($feature['description'] ?? null))
                                                <p class="feature-description m-0 text-xs leading-normal text-white text-left">
                                                    {{ $feature['description'] }}
                                                </p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if(!empty($layer['audiences'] ?? []))
                                <div class="mt-0 flex flex-wrap gap-2">
                                    @foreach($layer['audiences'] as $audience)
                                        <span class="inline-flex items-center justify-center py-2 px-3.5 rounded-full bg-white/15 font-medium text-xs text-white text-center">
                                            {{ $audience }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </main>

                <footer class="flex justify-between items-center gap-4 text-sm text-white mt-3">
                    <span>{{ $footerNote }}</span>
                    <span class="whitespace-nowrap">barrento.dev</span>
                </footer>
            </div>
        </div>
    </div>
</x-images-layout>
