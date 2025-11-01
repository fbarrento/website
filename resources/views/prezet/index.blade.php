@php
    /* @var array $nav */
    /* @var array|null|string $currentTag */
    /* @var array|null|string $currentCategory */
    /* @var \Illuminate\Support\Collection<int,\Prezet\Prezet\Data\DocumentData> $articles */
    /* @var \Illuminate\Support\Collection $postsByYear */
    /* @var \Illuminate\Support\Collection $allCategories */
    /* @var \Illuminate\Support\Collection $allTags */
@endphp

<x-prezet.template>
    @seo([
        'title' => 'Prezet: Markdown Blogging for Laravel',
        'description' =>
            'Transform your markdown files into SEO-friendly blogs, articles, and documentation!',
        'url' => route('prezet.index'),
    ])

    @if ($aboutPage)
        <div class="mx-auto max-w-4xl mb-16">
            <div class="bg-white dark:bg-zinc-900 rounded-lg p-8 shadow-sm ring-1 ring-zinc-200 dark:ring-zinc-800">
                <div class="prose prose-zinc dark:prose-invert max-w-none">
                    {!! $aboutPage->content !!}
                </div>

                @if ($aboutPage->frontmatter->github || $aboutPage->frontmatter->linkedin || $aboutPage->frontmatter->x || $aboutPage->frontmatter->pinkary)
                    <div class="mt-8 pt-6 border-t border-zinc-200 dark:border-zinc-800">
                        <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">Connect with me:</p>
                        <div class="flex gap-4">
                            @if ($aboutPage->frontmatter->github)
                                <a href="{{ $aboutPage->frontmatter->github }}" target="_blank" rel="noopener noreferrer" class="text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100 transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endif

                            @if ($aboutPage->frontmatter->linkedin)
                                <a href="{{ $aboutPage->frontmatter->linkedin }}" target="_blank" rel="noopener noreferrer" class="text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100 transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>
                            @endif

                            @if ($aboutPage->frontmatter->x)
                                <a href="{{ $aboutPage->frontmatter->x }}" target="_blank" rel="noopener noreferrer" class="text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100 transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                    </svg>
                                </a>
                            @endif

                            @if ($aboutPage->frontmatter->pinkary)
                                <a href="{{ $aboutPage->frontmatter->pinkary }}" target="_blank" rel="noopener noreferrer" class="text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100 transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm0 22C6.486 22 2 17.514 2 12S6.486 2 12 2s10 4.486 10 10-4.486 10-10 10zm0-16c-3.309 0-6 2.691-6 6s2.691 6 6 6 6-2.691 6-6-2.691-6-6-6zm0 10c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4z"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <div class="mx-auto max-w-4xl">
        <h1
            class="text-3xl !leading-snug font-bold sm:text-4xl lg:text-5xl lg:!leading-tight dark:text-white"
        >
            All Posts
        </h1>

        <div class="mb-6 justify-between sm:flex md:mb-8">
            <p class="text-lg leading-7 text-zinc-500 dark:text-zinc-400">
                A blog created with Laravel and Tailwind.css
            </p>
            <div class="mt-4 block sm:mt-0">
                @if ($currentTag)
                    <span
                        class="inline-flex items-center gap-x-0.5 rounded-md bg-zinc-50 px-2.5 py-1.5 text-xs font-medium text-zinc-600 ring-1 ring-zinc-500/10 ring-inset dark:bg-zinc-800 dark:text-zinc-300 dark:ring-zinc-700/20"
                    >
                        <x-prezet.icon-tag class="mr-1 size-3.5" />

                        {{ strtoupper($currentTag) }}
                        <a
                            href="{{ route('prezet.index', array_filter(request()->except('tag'))) }}"
                            class="group relative -mr-1 h-3.5 w-3.5 rounded-xs hover:bg-zinc-500/20 dark:hover:bg-zinc-600/30"
                        >
                            <span class="sr-only">Remove</span>
                            <svg
                                viewBox="0 0 14 14"
                                class="h-3.5 w-3.5 stroke-zinc-600/50 group-hover:stroke-zinc-600/75 dark:stroke-zinc-400/50 dark:group-hover:stroke-zinc-400/75"
                            >
                                <path d="M4 4l6 6m0-6l-6 6" />
                            </svg>
                            <span class="absolute -inset-1"></span>
                        </a>
                    </span>
                @endif

                @if ($currentCategory)
                    <span
                        class="inline-flex items-center gap-x-0.5 rounded-md bg-zinc-50 px-2.5 py-1.5 text-xs font-medium text-zinc-600 ring-1 ring-zinc-500/10 ring-inset dark:bg-zinc-800 dark:text-zinc-300 dark:ring-zinc-700/20"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="mr-1 size-3.5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"
                            />
                        </svg>

                        {{ $currentCategory }}
                        <a
                            href="{{ route('prezet.index', array_filter(request()->except('category'))) }}"
                            class="group relative -mr-1 h-3.5 w-3.5 rounded-xs hover:bg-zinc-500/20 dark:hover:bg-zinc-600/30"
                        >
                            <span class="sr-only">Remove</span>
                            <svg
                                viewBox="0 0 14 14"
                                class="h-3.5 w-3.5 stroke-zinc-600/50 group-hover:stroke-zinc-600/75 dark:stroke-zinc-400/50 dark:group-hover:stroke-zinc-400/75"
                            >
                                <path d="M4 4l6 6m0-6l-6 6" />
                            </svg>
                            <span class="absolute -inset-1"></span>
                        </a>
                    </span>
                @endif

                @if ($currentAuthor)
                    <span
                        class="inline-flex items-center gap-x-0.5 rounded-md bg-zinc-50 px-2.5 py-1.5 text-xs font-medium text-zinc-600 ring-1 ring-zinc-500/10 ring-inset dark:bg-zinc-800 dark:text-zinc-300 dark:ring-zinc-700/20"
                    >
                        <img
                            src="{{ $currentAuthor['image'] }}"
                            alt="{{ $currentAuthor['name'] }}"
                            class="mr-1 h-3.5 w-3.5 rounded-full"
                        />
                        {{ $currentAuthor['name'] }}
                        <a
                            href="{{ route('prezet.index', array_filter(request()->except('author'))) }}"
                            class="group relative -mr-1 h-3.5 w-3.5 rounded-xs hover:bg-zinc-500/20 dark:hover:bg-zinc-600/30"
                        >
                            <span class="sr-only">Remove</span>
                            <svg
                                viewBox="0 0 14 14"
                                class="h-3.5 w-3.5 stroke-zinc-600/50 group-hover:stroke-zinc-600/75 dark:stroke-zinc-400/50 dark:group-hover:stroke-zinc-400/75"
                            >
                                <path d="M4 4l6 6m0-6l-6 6" />
                            </svg>
                            <span class="absolute -inset-1"></span>
                        </a>
                    </span>
                @endif
            </div>
        </div>

        @foreach ($postsByYear as $year => $posts)
            <section class="mb-12">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div
                            class="w-full border-t border-zinc-200 dark:border-zinc-800"
                        ></div>
                    </div>
                    <div class="relative flex justify-start">
                        <span
                            class="bg-white pr-4 text-xl font-bold text-zinc-500 dark:bg-zinc-950 dark:text-zinc-400"
                        >
                            {{ $year }}
                        </span>
                    </div>
                </div>

                <div class="mt-8 space-y-12 text-zinc-900 dark:text-zinc-100">
                    @foreach ($posts as $post)
                        <x-prezet.article
                            :article="$post"
                            :author="config('prezet.authors.' . $post->frontmatter->author)"
                        />
                    @endforeach
                </div>
            </section>
        @endforeach
    </div>
</x-prezet.template>
