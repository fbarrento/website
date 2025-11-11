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

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="robots" content="noindex" />

        <title>{{ $title }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=inter:500,600,700&display=swap"
            rel="stylesheet"
        />

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
                -webkit-font-smoothing: antialiased;
                width: 2200px;
                height: 1100px;
                display: flex;
                align-items: stretch;
                background: {{ $backgroundHorizontal }};
            }

            .frame {
                flex: 1;
                display: flex;
                padding: 60px 88px;
                border-radius: 24px;
                margin: 24px;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(22px);
                box-shadow: 0 32px 80px rgba(15, 23, 42, 0.35);
            }

            .content {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                width: 100%;
            }

            header {
                display: flex;
                justify-content: flex-start;
                margin-bottom: 32px;
            }

            h1 {
                margin: 0;
                font-size: 48px;
                line-height: 1.2;
                font-weight: 500;
                color: #fff;
                text-shadow: 0 2px 8px rgba(139, 92, 246, 0.3), 0 1px 4px rgba(59, 130, 246, 0.2);
            }

            main {
                display: flex;
                flex-direction: column;
                gap: 28px;
            }

            .layer-card {
                border-radius: 16px;
                border: 1px solid rgba(255, 255, 255, 0.2);
                background: rgba(255, 255, 255, 0.45);
                padding: 32px 40px;
                backdrop-filter: blur(16px);
                display: flex;
                flex-direction: column;
                gap: 20px;
                box-shadow: 0 8px 32px rgba(139, 92, 246, 0.3), 0 4px 16px rgba(59, 130, 246, 0.2), 0 2px 8px rgba(236, 72, 153, 0.15);
            }

            .layer-header {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .layer-label {
                margin: 0;
                font-size: 12px;
                letter-spacing: 0.3em;
                text-transform: uppercase;
                color: #fff;
            }

            .layer-heading {
                margin: 0;
                font-size: 40px;
                font-weight: 600;
                color: #fff;
                text-shadow: 0 2px 8px rgba(139, 92, 246, 0.25), 0 1px 4px rgba(59, 130, 246, 0.15);
            }

            .feature-grid {
                margin-top: 0;
                display: grid;
                gap: 16px;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                flex: 1;
            }

            .feature-card {
                border-radius: 12px;
                border: 1px solid rgba(255, 255, 255, 0.2);
                background: rgba(255, 255, 255, 0.4);
                padding: 24px 28px;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                justify-content: flex-start;
                gap: 12px;
                min-height: 80px;
                box-shadow: 0 6px 24px rgba(139, 92, 246, 0.25), 0 3px 12px rgba(59, 130, 246, 0.15), 0 1px 6px rgba(236, 72, 153, 0.1);
            }

            .feature-header {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .feature-icon {
                width: 28px;
                height: 28px;
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
                font-size: 20px;
                font-weight: 600;
                color: #fff;
                line-height: 1.3;
                text-align: left;
                text-shadow: 0 1px 4px rgba(139, 92, 246, 0.2);
            }

            .feature-description {
                margin: 0;
                font-size: 14px;
                line-height: 1.5;
                color: #fff;
                text-align: left;
            }

            .audience-grid {
                margin-top: 0;
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
            }

            .audience-pill {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 12px 20px;
                border-radius: 999px;
                border: 1px solid rgba(255, 255, 255, 0.2);
                background: rgba(255, 255, 255, 0.4);
                font-weight: 500;
                font-size: 16px;
                color: #fff;
                text-align: center;
                box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2), 0 2px 6px rgba(59, 130, 246, 0.15);
            }

            footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 16px;
                font-size: 18px;
                color: #fff;
                margin-top: 16px;
            }
        </style>
    </head>
    <body>
        <div class="frame">
            <div class="content">
                <header>
                    <h1>
                        Laravel Cloud SDK Architecture at a glance.
                    </h1>
                </header>

                <main>
                    @foreach($layers as $layer)
                        <div class="layer-card">
                            <div class="layer-header">
                                <p class="layer-label">
                                    {{ $layer['label'] }}
                                </p>
                                <h2 class="layer-heading">
                                    {{ $layer['heading'] }}
                                </h2>
                            </div>
                            @if(!empty($layer['features'] ?? []))
                                <div class="feature-grid">
                                    @foreach($layer['features'] as $feature)
                                        <div class="feature-card">
                                            <div class="feature-header">
                                                @if(!empty($feature['icon'] ?? null))
                                                    <div class="feature-icon">
                                                        <x-icon name="lucide-{{ $feature['icon'] }}" class="feature-icon-svg" />
                                                    </div>
                                                @endif
                                                <p class="feature-title">
                                                    {{ $feature['title'] }}
                                                </p>
                                            </div>
                                            @if(!empty($feature['description'] ?? null))
                                                <p class="feature-description">
                                                    {{ $feature['description'] }}
                                                </p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if(!empty($layer['audiences'] ?? []))
                                <div class="audience-grid">
                                    @foreach($layer['audiences'] as $audience)
                                        <span class="audience-pill">
                                            {{ $audience }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </main>

                <footer>
                    <span>{{ $footerNote }}</span>
                    <span style="white-space:nowrap;">barrento.dev</span>
                </footer>
            </div>
        </div>
    </body>
</html>

