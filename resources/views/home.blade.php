@php use Illuminate\Support\Collection;use Prezet\Prezet\Data\DocumentData; @endphp
@php
    /* @var array $author */
    /* @var DocumentData|null $aboutPage */
    /* @var Collection<int,DocumentData> $latestPosts */
@endphp

<x-prezet.template>
    @seo([
        'title' => $author['name'] ?? config('app.name', 'Laravel'),
        'description' => $aboutPage->frontmatter->excerpt ?? 'Personal website and blog',
        'url' => route('home'),
        'image' => '/storage/images/francisco.webp',
    ])

    <main class="max-w-6xl mx-auto py-12 sm:py-16 lg:py-20">
        <div class="flex flex-col space-y-16">
            <section>
                <div
                    class="prose prose-green prose-h1:font-light prose-p:mb-4 prose-h1:text-3xl dark:prose-invert max-w-none">
                    {!! $aboutPage->content !!}
                </div>
            </section>

            {{-- Latest Posts Section --}}
            <section>
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl sm:text-3xl font-bold text-black dark:text-white">
                        Latest Posts
                    </h2>
                    <a
                        href="{{ route('prezet.index') }}"
                        class="text-sm text-gray-600 dark:text-gray-400 hover:text-black dark:hover:text-white transition-colors"
                    >
                        View all →
                    </a>
                </div>

                @if ($latestPosts->count() > 0)
                    <div class="space-y-8">
                        @foreach ($latestPosts as $post)
                            <article
                                class="border-b border-[#e3e3e0] dark:border-[#3E3E3A] pb-8 last:border-0 last:pb-0">
                                <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                                    <div class="flex-1">
                                        @if ($post->category)
                                            <a
                                                href="{{ route('prezet.index', ['category' => strtolower($post->category)]) }}"
                                                class="inline-block text-xs font-medium text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-wide"
                                            >
                                                {{ $post->category }}
                                            </a>
                                        @endif
                                        <h3 class="text-xl sm:text-2xl font-semibold mb-2 text-black dark:text-white">
                                            <a
                                                href="{{ route('prezet.show', $post->slug) }}"
                                                class="hover:opacity-75 transition-opacity"
                                            >
                                                {{ $post->frontmatter->title }}
                                            </a>
                                        </h3>
                                        @if ($post->frontmatter->excerpt)
                                            <p class="text-gray-600 dark:text-gray-400 mb-3 leading-relaxed">
                                                {{ $post->frontmatter->excerpt }}
                                            </p>
                                        @endif
                                        <div class="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-500">
                                            <time datetime="{{ $post->createdAt->toIso8601String() }}">
                                                {{ $post->createdAt->format('F j, Y') }}
                                            </time>
                                            @if ($post->frontmatter->tags && count($post->frontmatter->tags) > 0)
                                                <span class="text-gray-300 dark:text-gray-600">•</span>
                                                <div class="flex flex-wrap gap-2">
                                                    @foreach (array_slice($post->frontmatter->tags, 0, 3) as $tag)
                                                        <a
                                                            href="{{ route('prezet.index', ['tag' => strtolower($tag)]) }}"
                                                            class="hover:text-black dark:hover:text-white transition-colors"
                                                        >
                                                            {{ $tag }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600 dark:text-gray-400">
                        No posts yet. Check back soon!
                    </p>
                @endif
            </section>
        </div>
    </main>
</x-prezet.template>
