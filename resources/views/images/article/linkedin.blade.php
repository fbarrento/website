@php
    /**
    * @var string $title
    * @var string $tagline
    * @var string|null $excerpt
    * @var string|null $authorName
    * @var string|null $authorBio
    * @var string|null $date
    * @var array<int, string> $tags
    * @var string|null $category
    * @var string $footerNote
    * @var string $theme
    * @var string $backgroundVertical
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
        <link href="https://fonts.bunny.net/css?family=inter:500,600,700&display=swap" rel="stylesheet" />

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
                background: {{ $backgroundVertical }};
                display: flex;
                width: 1080px;
                height: 1920px;
                -webkit-font-smoothing: antialiased;
            }

            .layout {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                padding: 80px 96px;
                width: 100%;
            }

            header {
                display: flex;
                flex-direction: column;
                gap: 24px;
            }

            .category {
                display: inline-flex;
                align-items: center;
                padding: 12px 24px;
                border-radius: 999px;
                border: 1px solid rgba(255, 255, 255, 0.18);
                background: rgba(255, 255, 255, 0.08);
                font-size: 14px;
                letter-spacing: 0.2em;
                text-transform: uppercase;
                color: rgba(255, 255, 255, 0.85);
                font-weight: 500;
                width: fit-content;
            }

            h1 {
                margin: 0;
                font-size: 72px;
                line-height: 1.1;
                font-weight: 700;
                color: #fff;
            }

            .excerpt {
                margin: 0;
                font-size: 32px;
                line-height: 1.6;
                color: rgba(255, 255, 255, 0.85);
                font-weight: 400;
            }

            .tags {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                margin-top: 16px;
            }

            .tag {
                display: inline-flex;
                align-items: center;
                padding: 10px 20px;
                border-radius: 999px;
                border: 1px solid rgba(255, 255, 255, 0.16);
                background: rgba(255, 255, 255, 0.12);
                color: rgba(255, 255, 255, 0.82);
                font-size: 18px;
                font-weight: 500;
            }

            footer {
                display: flex;
                flex-direction: column;
                gap: 12px;
                padding-top: 32px;
                margin-top: 32px;
                font-size: 20px;
                color: rgba(255, 255, 255, 0.62);
            }

            .author {
                font-weight: 600;
                color: rgba(255, 255, 255, 0.85);
            }

            .date {
                color: rgba(255, 255, 255, 0.62);
            }
        </style>
    </head>
    <body>
        <div class="layout">
            <header>
                @if ($category)
                    <div class="category">{{ $category }}</div>
                @endif

                <h1>{{ $title }}</h1>
                @if ($excerpt)
                    <p class="excerpt">{{ $excerpt }}</p>
                @endif

                @if (! empty($tags))
                    <div class="tags">
                        @foreach ($tags as $tag)
                            <span class="tag">{{ $tag }}</span>
                        @endforeach
                    </div>
                @endif
            </header>

            <footer>
                @if ($authorName)
                    <div class="author">{{ $authorName }}</div>
                @endif

                @if ($date)
                    <div class="date">{{ $date }}</div>
                @endif

                <div>{{ $footerNote }}</div>
            </footer>
        </div>
    </body>
</html>
