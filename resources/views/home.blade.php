@php
    use Illuminate\Support\Collection;
    use Prezet\Prezet\Data\DocumentData;
@endphp

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

    <main class="mx-auto max-w-6xl pt-12 sm:pt-16 lg:pt-20">
        <div class="flex flex-col space-y-16">
            <section>
                <div
                    class="prose prose-green prose-h1:font-light prose-p:mb-4 prose-h1:text-3xl dark:prose-invert max-w-none"
                >
                    {!! $aboutPage->content !!}
                </div>
            </section>

            {{-- Latest Posts Section --}}
            <section>
                <div class="mb-8 flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-black sm:text-3xl dark:text-white">Latest Posts</h2>
                    <a
                        href="{{ route('prezet.index') }}"
                        class="text-sm text-gray-600 transition-colors hover:text-black dark:text-gray-400 dark:hover:text-white"
                    >
                        View all →
                    </a>
                </div>

                @if ($latestPosts->count() > 0)
                    <div class="space-y-8">
                        @foreach ($latestPosts as $post)
                            <article
                                class="border-b border-[#e3e3e0] pb-8 last:border-0 last:pb-0 dark:border-[#3E3E3A]"
                            >
                                <div class="flex flex-col gap-4 sm:flex-row sm:items-start">
                                    <div class="flex-1">
                                        @if ($post->category)
                                            <a
                                                href="{{ route('prezet.index', ['category' => strtolower($post->category)]) }}"
                                                class="mb-2 inline-block text-xs font-medium tracking-wide text-gray-500 uppercase dark:text-gray-400"
                                            >
                                                {{ $post->category }}
                                            </a>
                                        @endif

                                        <h3 class="mb-2 text-xl font-semibold text-black sm:text-2xl dark:text-white">
                                            <a
                                                href="{{ route('prezet.show', $post->slug) }}"
                                                class="transition-opacity hover:opacity-75"
                                            >
                                                {{ $post->frontmatter->title }}
                                            </a>
                                        </h3>
                                        @if ($post->frontmatter->excerpt)
                                            <p class="mb-3 leading-relaxed text-gray-600 dark:text-gray-400">
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
                                                            class="transition-colors hover:text-black dark:hover:text-white"
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
                    <p class="text-gray-600 dark:text-gray-400">No posts yet. Check back soon!</p>
                @endif
            </section>
        </div>
    </main>
    <div class="my-12 sm:my-16 lg:my-20">
        <x-newsletter.inline />
    </div>
</x-prezet.template>
