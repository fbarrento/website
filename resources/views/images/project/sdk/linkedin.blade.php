@php
    /**
     * @var string $title
     * @var string $tagline
     * @var array<int, array{label: string, heading: string, description: string, features?: array<int, array{title: string, description: string}>}> $layers
     * @var array<int, array{title: string, description: string}> $highlights
     * @var array<int, string> $audiences
     * @var string $footerNote
     * @var string $theme
     * @var string $backgroundVertical
     */
@endphp
<x-images-layout>
@push('styles')
    <style>
        :root {
            color-scheme: dark;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: #f8fafc;
            display: flex;
            width: 1080px;
            height: 1350px;
            -webkit-font-smoothing: antialiased;
            position: relative;
            overflow: hidden;
        }

        .layout {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            padding: 60px 72px 40px;
            width: 100%;
            position: relative;
            z-index: 1;
        }

        .gradient-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            pointer-events: none;
        }

        .gradient-orb-1 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.4) 0%, rgba(59, 130, 246, 0.3) 50%, transparent 100%);
            top: -150px;
            right: -100px;
        }

        .gradient-orb-2 {
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(236, 72, 153, 0.35) 0%, rgba(139, 92, 246, 0.25) 50%, transparent 100%);
            bottom: -120px;
            left: -80px;
        }

        .gradient-orb-3 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.3) 0%, rgba(236, 72, 153, 0.2) 50%, transparent 100%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 10px 24px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.4);
            font-size: 14px;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            color: #fff;
            font-weight: 500;
            margin-bottom: 32px;
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 16px rgba(139, 92, 246, 0.2), 0 2px 8px rgba(59, 130, 246, 0.15), 0 1px 4px rgba(236, 72, 153, 0.1);
        }

        h1 {
            margin: 0;
            font-size: 76px;
            line-height: 1.1;
            font-weight: 600;
            color: #fff;
            text-shadow: 0 2px 8px rgba(139, 92, 246, 0.3), 0 1px 4px rgba(59, 130, 246, 0.2);
        }

        .title {
            font-size: 46px;
            line-height: 1.2;
            font-weight: 500;
            color: #fff;
            margin: 0;
            text-shadow: 0 2px 8px rgba(139, 92, 246, 0.3), 0 1px 4px rgba(59, 130, 246, 0.2);
        }

        .tagline {
            margin-top: 16px;
            max-width: 48ch;
            font-size: 24px;
            line-height: 1.6;
            color: #fff;
        }

        .layer-grid {
            display: grid;
            gap: 32px;
        }

        .layer-card {
            border-radius: 32px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.45);
            padding: 56px;
            backdrop-filter: blur(40px);
            position: relative;
            box-shadow: 0 8px 32px rgba(139, 92, 246, 0.3), 0 4px 16px rgba(59, 130, 246, 0.2), 0 2px 8px rgba(236, 72, 153, 0.15);
        }

        .layer-label {
            margin: 0;
            font-size: 18px;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: #fff;
            font-weight: 500;
        }

        .layer-heading {
            margin: 20px 0 16px;
            font-size: 44px;
            line-height: 1.3;
            font-weight: 600;
            color: #fff;
            text-shadow: 0 2px 8px rgba(139, 92, 246, 0.25), 0 1px 4px rgba(59, 130, 246, 0.15);
        }

        .section-title {
            margin: 0 0 20px;
            font-size: 20px;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: #fff;
            font-weight: 500;
        }

        .feature-grid {
            margin-top: 32px;
            display: grid;
            gap: 28px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .feature-card {
            border-radius: 22px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.4);
            padding: 48px;
            backdrop-filter: blur(30px);
            position: relative;
            box-shadow: 0 6px 24px rgba(139, 92, 246, 0.25), 0 3px 12px rgba(59, 130, 246, 0.15), 0 1px 6px rgba(236, 72, 153, 0.1);
        }

        .feature-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 12px;
        }

        .feature-icon {
            width: 32px;
            height: 32px;
            flex-shrink: 0;
            color: rgba(255, 255, 255, 0.9);
        }

        .feature-icon svg,
        .feature-icon-svg {
            width: 100%;
            height: 100%;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .feature-title {
            margin: 0;
            font-size: 26px;
            line-height: 1.3;
            font-weight: 600;
            color: #fff;
            text-shadow: 0 1px 4px rgba(139, 92, 246, 0.2);
        }

        .feature-description {
            margin: 18px 0 0;
            font-size: 22px;
            line-height: 1.75;
            color: #fff;
        }

        .audience-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        .audience-pill {
            display: inline-flex;
            align-items: center;
            padding: 14px 24px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.4);
            color: #fff;
            font-size: 19px;
            font-weight: 500;
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2), 0 2px 6px rgba(59, 130, 246, 0.15);
        }

    </style>
@endpush
<div class="flex items-center justify-center w-full h-full relative bg-linear-to-b from-indigo-900 to-indigo-950 ">

    <div class="layout mx-auto">
        <header class="mb-5">
            <div class="px-4 rounded-full py-2 bg-white/15 inline-block uppercase tracking-widest mb-4">
                Laravel Cloud SDK
            </div>

            <div>
                <h1 class="title">Laravel Cloud SDK Architecture at a glance.</h1>
            </div>
        </header>

        <main class="flex flex-col my-3 space-y-8">
            <section class="flex flex-col space-y-6">
                @foreach($layers as $layer)
                    <div class="p-8 rounded-4xl bg-white/10">
                        <p class="layer-label">
                            {{ $layer['label'] }}
                        </p>
                        <h2 class="layer-heading">
                            {{ $layer['heading'] }}
                        </h2>
                        @if(!empty($layer['features'] ?? []))
                            <div class="feature-grid">
                                @foreach($layer['features'] as $feature)
                                    <div class="px-5 rounded-3xl py-5 bg-white/10">
                                        <div class="feature-header">
                                            @if(!empty($feature['icon'] ?? null))
                                                <div class="feature-icon">
                                                    <x-icon name="lucide-{{ $feature['icon'] }}" class="feature-icon-svg"/>
                                                </div>
                                            @endif
                                            <p class="feature-title">
                                                {{ $feature['title'] }}
                                            </p>
                                        </div>
                                        <p class="feature-description">
                                            {{ $feature['description'] }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </section>

            <section class="mt-2">
                <h2 class="section-title">
                    Works anywhere
                </h2>
                <div class="audience-tags">
                    @foreach($audiences as $audience)
                        <div class="px-4 rounded-full py-2 bg-white/15 inline-block uppercase tracking-widest">
                            {{ $audience }}
                        </div>
                    @endforeach
                </div>
            </section>
        </main>
    </div>
</div>
</x-images-layout>

