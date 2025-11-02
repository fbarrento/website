@php use Illuminate\Support\Collection;use Prezet\Prezet\Data\DocumentData; @endphp
@php
    /* @var array $nav */
    /* @var array|null|string $currentTag */
    /* @var array|null|string $currentCategory */
    /* @var Collection<int,DocumentData> $articles */
    /* @var Collection $postsByYear */
    /* @var Collection $allCategories */
    /* @var Collection $allTags */
@endphp

<x-prezet.template>
    @seo([
        'title' => 'Francisco Barrento',
        'description' =>
            'Laravel tutorials, PHP development tips, and testing best practices. Learn about Inertia, Pest, AI integration, and building maintainable applications.',
        'url' => route('prezet.index'),
    ])

    <div class="mx-auto max-w-6xl py-12 sm:py-16 lg:py-20">
        <h1
            class="text-3xl !leading-snug font-bold sm:text-4xl lg:text-5xl lg:!leading-tight dark:text-white"
        >
            Blog
        </h1>

        <div class="mb-6 justify-between sm:flex md:mb-8">
            <p class="text-lg leading-7 text-gray-600 dark:text-gray-400">
                All latest Barrento's posts in one place.
            </p>
            <div class="mt-4 block sm:mt-0">
                @if ($currentTag)
                    <span
                        class="inline-flex items-center gap-x-0.5 rounded-md bg-gray-50 px-2.5 py-1.5 text-xs font-medium text-gray-600 ring-1 ring-gray-500/10 ring-inset dark:bg-[#1a1a1a] dark:text-gray-300 dark:ring-[#3E3E3A]"
                    >
                        <x-prezet.icon-tag class="mr-1 size-3.5"/>

                        {{ strtoupper($currentTag) }}
                        <a
                            href="{{ route('prezet.index', array_filter(request()->except('tag'))) }}"
                            class="group relative -mr-1 h-3.5 w-3.5 rounded-xs hover:bg-gray-500/20 dark:hover:bg-gray-600/30"
                        >
                            <span class="sr-only">Remove</span>
                            <svg
                                viewBox="0 0 14 14"
                                class="h-3.5 w-3.5 stroke-gray-600/50 group-hover:stroke-gray-600/75 dark:stroke-gray-400/50 dark:group-hover:stroke-gray-400/75"
                            >
                                <path d="M4 4l6 6m0-6l-6 6"/>
                            </svg>
                            <span class="absolute -inset-1"></span>
                        </a>
                    </span>
                @endif

                @if ($currentCategory)
                    <span
                        class="inline-flex items-center gap-x-0.5 rounded-md bg-gray-50 px-2.5 py-1.5 text-xs font-medium text-gray-600 ring-1 ring-gray-500/10 ring-inset dark:bg-[#1a1a1a] dark:text-gray-300 dark:ring-[#3E3E3A]"
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
                            class="group relative -mr-1 h-3.5 w-3.5 rounded-xs hover:bg-gray-500/20 dark:hover:bg-gray-600/30"
                        >
                            <span class="sr-only">Remove</span>
                            <svg
                                viewBox="0 0 14 14"
                                class="h-3.5 w-3.5 stroke-gray-600/50 group-hover:stroke-gray-600/75 dark:stroke-gray-400/50 dark:group-hover:stroke-gray-400/75"
                            >
                                <path d="M4 4l6 6m0-6l-6 6"/>
                            </svg>
                            <span class="absolute -inset-1"></span>
                        </a>
                    </span>
                @endif

                @if ($currentAuthor)
                    <span
                        class="inline-flex items-center gap-x-0.5 rounded-md bg-gray-50 px-2.5 py-1.5 text-xs font-medium text-gray-600 ring-1 ring-gray-500/10 ring-inset dark:bg-[#1a1a1a] dark:text-gray-300 dark:ring-[#3E3E3A]"
                    >
                        <img
                            src="{{ $currentAuthor['image'] }}"
                            alt="{{ $currentAuthor['name'] }}"
                            class="mr-1 h-3.5 w-3.5 rounded-full"
                        />
                        {{ $currentAuthor['name'] }}
                        <a
                            href="{{ route('prezet.index', array_filter(request()->except('author'))) }}"
                            class="group relative -mr-1 h-3.5 w-3.5 rounded-xs hover:bg-gray-500/20 dark:hover:bg-gray-600/30"
                        >
                            <span class="sr-only">Remove</span>
                            <svg
                                viewBox="0 0 14 14"
                                class="h-3.5 w-3.5 stroke-gray-600/50 group-hover:stroke-gray-600/75 dark:stroke-gray-400/50 dark:group-hover:stroke-gray-400/75"
                            >
                                <path d="M4 4l6 6m0-6l-6 6"/>
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
                            class="w-full border-t border-[#e3e3e0] dark:border-[#3E3E3A]"
                        ></div>
                    </div>
                    <div class="relative flex justify-start">
                        <span
                            class="bg-white pr-4 text-xl font-bold text-gray-500 dark:bg-[#0a0a0a] dark:text-gray-400"
                        >
                            {{ $year }}
                        </span>
                    </div>
                </div>

                <div class="mt-8 space-y-12 text-black dark:text-white">
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
