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
                padding: 80px 120px;
                border-radius: 24px;
                margin: 32px;
                background: rgba(0, 0, 0, 0.38);
                border: 1px solid rgba(255, 255, 255, 0.14);
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
                font-size: 16px;
                letter-spacing: 0.2em;
                text-transform: uppercase;
                color: rgba(255, 255, 255, 0.85);
                font-weight: 500;
                width: fit-content;
            }

            h1 {
                margin: 0;
                font-size: 88px;
                line-height: 1.1;
                font-weight: 700;
                color: #fff;
            }

            .excerpt {
                margin: 0;
                font-size: 40px;
                line-height: 1.5;
                color: rgba(255, 255, 255, 0.85);
                font-weight: 400;
            }

            .tags {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                margin-top: 20px;
            }

            .tag {
                display: inline-flex;
                align-items: center;
                padding: 12px 24px;
                border-radius: 999px;
                border: 1px solid rgba(255, 255, 255, 0.16);
                background: rgba(255, 255, 255, 0.12);
                color: rgba(255, 255, 255, 0.82);
                font-size: 22px;
                font-weight: 500;
            }

            footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 24px;
                font-size: 24px;
                color: rgba(255, 255, 255, 0.62);
                margin-top: 24px;
            }

            .author-date {
                display: flex;
                flex-direction: column;
                gap: 8px;
            }

            .author {
                font-weight: 600;
                color: rgba(255, 255, 255, 0.85);
            }

            .date {
                font-size: 20px;
                color: rgba(255, 255, 255, 0.62);
            }
        </style>
    </head>
    <body>
        <div class="frame">
            <div class="content">
                <header>
                    @if($category)
                        <div class="category">{{ $category }}</div>
                    @endif
                    <h1>{{ $title }}</h1>
                    @if($excerpt)
                        <p class="excerpt">{{ $excerpt }}</p>
                    @endif
                    @if(!empty($tags))
                        <div class="tags">
                            @foreach($tags as $tag)
                                <span class="tag">{{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif
                </header>

                <footer>
                    <div class="author-date">
                        @if($authorName)
                            <div class="author">{{ $authorName }}</div>
                        @endif
                        @if($date)
                            <div class="date">{{ $date }}</div>
                        @endif
                    </div>
                    <div>{{ $footerNote }}</div>
                </footer>
            </div>
        </div>
    </body>
</html>

