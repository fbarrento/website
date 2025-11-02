@php use Prezet\Prezet\Data\DocumentData; @endphp
@php
    /* @var string $body */
    /* @var array $nav */
    /* @var array $headings */
    /* @var string $linkedData */
    /* @var DocumentData $document */
@endphp

<x-prezet.template>
    @seo([
        'title' => $document->frontmatter->title,
        'description' => $document->frontmatter->excerpt,
        'url' => route('prezet.show', ['slug' => $document->slug]),
        'image' => url($document->frontmatter->image),
    ])

    @push('jsonld')
        <script type="application/ld+json">
            {!! $linkedData !!}
        </script>
    @endpush

    <x-prezet.alpine>
        <div class="mx-auto w-full max-w-4xl px-6 py-20">
            <div class="mb-10">
                <li class="flex items-center dark:text-white">
                    @if($document->category)
                        <a
                            href="{{ route('prezet.show', ['slug' => strtolower($document->category)]) }}"
                        >
                            {{ $document->category }}
                        </a>
                    @endif
                </li>

                <h1
                    class="mb-1 text-3xl !leading-snug font-bold sm:text-4xl lg:text-6xl lg:!leading-tight dark:text-white"
                >
                    {{ $document->frontmatter->title }}
                </h1>
                <div class="text-sm">
                    <span class="inline">Last updated on {{ $document->updatedAt->toFormattedDateString() }} by</span>
                    <a
                        href="#author"
                    >
                            <span
                                class="hover:text-primary transition-all duration-300"
                            >
                                {{ $author['name'] }}
                            </span>
                    </a>
                </div>
            </div>
            {{-- Hero Image --}}
            {{--
                <div class="-mx-8 sm:mx-0 col-span-12 xl:col-start-2 xl:col-span-10 lg:my-4">
                <img
                src="/prezet/img/bobs.webp"
                alt="bob"
                width="1120"
                height="595"
                loading="lazy"
                decoding="async"
                    class="h-auto max-h-[500px] w-full sm:rounded-2xl bg-gray-50 object-cover dark:bg-[#1a1a1a]"
                />
                </div>
            --}}

            <div
                class="col-span-12 xl:col-span-10 xl:col-start-2 2xl:col-span-10 2xl:col-start-2"
            >
            </div>

            <div class="col-span-12 lg:hidden">
                <div
                    class="h-px w-full border-0 bg-[#e3e3e0] dark:bg-[#3E3E3A]"
                ></div>
            </div>

            {{-- Main Content --}}
            <div
                class="col-span-12 lg:col-span-9 xl:col-span-8 xl:col-start-2 2xl:col-span-7 2xl:col-start-2"
            >
                {{-- prose-pre:-mx-8 prose-pre:rounded-none --}}
                <article
                    class="prose-pre:rounded-xl prose-headings:font-display prose prose-zinc prose-a:border-b prose-a:border-dashed prose-a:border-black/30 prose-a:font-semibold prose-a:no-underline prose-a:hover:border-solid prose-img:rounded-sm dark:prose-invert max-w-none"
                >
                    {!! $body !!}
                </article>

                <div
                    class="border-dark/5 my-10 flex flex-col justify-start gap-y-5 border-t pt-10"
                >
                    @if ($document->frontmatter->tags)
                        <ul class="flex flex-wrap items-center gap-2 sm:gap-3">
                            <li>
                                @foreach ($document->frontmatter->tags as $tag)
                                    <a
                                        href="{{ route('prezet.index', ['tag' => strtolower($tag)]) }}"
                                        class="inline-flex items-center rounded-md bg-gray-50 px-3 py-1.5 text-xs text-gray-800 ring-1 ring-gray-500/10 transition ring-inset hover:bg-gray-200 dark:bg-[#1a1a1a] dark:text-gray-200 dark:ring-[#3E3E3A] dark:hover:bg-gray-800"
                                    >
                                        <x-prezet.icon-tag
                                            class="mr-1 h-3 w-3"
                                        />

                                        {{ $tag }}
                                    </a>
                                @endforeach
                            </li>
                        </ul>
                    @endif
                </div>
                <div
                    id="author"
                    class="flex flex-col items-start gap-x-6 gap-y-4 rounded-xl bg-gray-50 p-6 ring-1 ring-gray-500/10 ring-inset md:flex-row md:p-7 dark:bg-[#1a1a1a] dark:text-gray-300"
                >
                    <img
                        src="{{ $author['image'] }}"
                        alt="profile image of {{ $author['name'] }}"
                        width="135"
                        height="135"
                        loading="lazy"
                        decoding="async"
                        class="h-24 w-24 rounded-xl bg-gray-100 object-cover md:h-[135px] md:w-[135px] dark:bg-[#1a1a1a]"
                    />
                    <div>
                        <p
                            class="text-[20px] font-medium text-black md:text-2xl dark:text-white"
                        >
                            {{ $author['name'] }}
                        </p>
                        <div
                            class="mt-2 text-gray-600 md:mt-3 dark:text-gray-400"
                        >
                            <p class="dark">
                                {{ $author['bio'] }}
                            </p>
                        </div>
                        <a
                            class="hover:text-primary dark:hover:text-primary-dark mt-3 flex w-fit items-center gap-x-1 text-sm font-medium underline md:text-base dark:text-gray-200"
                            href="{{ route('prezet.index', ['author' => strtolower($document->frontmatter->author)]) }}"
                        >
                            More posts from {{ $author['name'] }}
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-4"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25"
                                />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-prezet.alpine>
</x-prezet.template>
