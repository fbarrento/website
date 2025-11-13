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
                background: radial-gradient(
                    circle,
                    rgba(139, 92, 246, 0.4) 0%,
                    rgba(59, 130, 246, 0.3) 50%,
                    transparent 100%
                );
                top: -100px;
                right: -50px;
            }

            .gradient-orb-2 {
                width: 250px;
                height: 250px;
                background: radial-gradient(
                    circle,
                    rgba(236, 72, 153, 0.35) 0%,
                    rgba(139, 92, 246, 0.25) 50%,
                    transparent 100%
                );
                bottom: -80px;
                left: -30px;
            }

            .gradient-orb-3 {
                width: 200px;
                height: 200px;
                background: radial-gradient(
                    circle,
                    rgba(59, 130, 246, 0.3) 0%,
                    rgba(236, 72, 153, 0.2) 50%,
                    transparent 100%
                );
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            .layer-card {
                box-shadow:
                    0 8px 32px rgba(139, 92, 246, 0.3),
                    0 4px 16px rgba(59, 130, 246, 0.2),
                    0 2px 8px rgba(236, 72, 153, 0.15);
            }

            .feature-card {
                box-shadow:
                    0 6px 24px rgba(139, 92, 246, 0.25),
                    0 3px 12px rgba(59, 130, 246, 0.15),
                    0 1px 6px rgba(236, 72, 153, 0.1);
            }

            .audience-pill {
                box-shadow:
                    0 4px 12px rgba(139, 92, 246, 0.2),
                    0 2px 6px rgba(59, 130, 246, 0.15);
            }

            h1 {
                text-shadow:
                    0 2px 8px rgba(139, 92, 246, 0.3),
                    0 1px 4px rgba(59, 130, 246, 0.2);
            }

            .layer-heading {
                text-shadow:
                    0 2px 8px rgba(139, 92, 246, 0.25),
                    0 1px 4px rgba(59, 130, 246, 0.15);
            }

            .feature-title {
                text-shadow: 0 1px 4px rgba(139, 92, 246, 0.2);
            }
        </style>
    @endpush

    <div class="relative flex h-full w-full items-center justify-center bg-linear-to-b from-indigo-900 to-indigo-950">
        <div class="mx-auto p-8">
            <div class="relative z-10 flex flex-col justify-between">
                <header class="mb-5 flex justify-start">
                    <h1 class="m-0 text-[28px] leading-tight font-medium text-white">
                        Laravel Cloud SDK Architecture at a glance.
                    </h1>
                </header>

                <main class="flex flex-col gap-5">
                    @foreach ($layers as $layer)
                        <div class="relative flex flex-col gap-4 rounded-xl bg-white/10 p-5 px-7">
                            <div class="flex flex-col gap-2">
                                <p class="m-0 text-[9px] tracking-[0.3em] text-white uppercase">
                                    {{ $layer['label'] }}
                                </p>
                                <h2 class="m-0 text-[28px] font-semibold text-white">
                                    {{ $layer['heading'] }}
                                </h2>
                            </div>
                            @if (! empty($layer['features'] ?? []))
                                <div class="mt-0 grid flex-1 grid-cols-4 gap-3">
                                    @foreach ($layer['features'] as $feature)
                                        <div
                                            class="relative flex min-h-[60px] flex-col items-start justify-start gap-2.5 rounded-lg bg-white/10 p-4 px-5"
                                        >
                                            <div class="flex items-center gap-2.5">
                                                @if (! empty($feature['icon'] ?? null))
                                                    <div class="h-5 w-5 shrink-0 text-white/90">
                                                        <x-icon
                                                            name="lucide-{{ $feature['icon'] }}"
                                                            class="h-full w-full fill-none stroke-current stroke-2 [stroke-linecap:round] [stroke-linejoin:round]"
                                                        />
                                                    </div>
                                                @endif

                                                <p
                                                    class="feature-title m-0 text-left text-[15px] leading-tight font-semibold text-white"
                                                >
                                                    {{ $feature['title'] }}
                                                </p>
                                            </div>
                                            @if (! empty($feature['description'] ?? null))
                                                <p
                                                    class="feature-description m-0 text-left text-xs leading-normal text-white"
                                                >
                                                    {{ $feature['description'] }}
                                                </p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if (! empty($layer['audiences'] ?? []))
                                <div class="mt-0 flex flex-wrap gap-2">
                                    @foreach ($layer['audiences'] as $audience)
                                        <span
                                            class="inline-flex items-center justify-center rounded-full bg-white/15 px-3.5 py-2 text-center text-xs font-medium text-white"
                                        >
                                            {{ $audience }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </main>

                <footer class="mt-3 flex items-center justify-between gap-4 text-sm text-white">
                    <span>{{ $footerNote }}</span>
                    <span class="whitespace-nowrap">barrento.dev</span>
                </footer>
            </div>
        </div>
    </div>
</x-images-layout>
