@php
    use Prezet\Prezet\Data\DocumentData;
@endphp

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
        <div class="mx-auto w-full max-w-4xl pt-12 sm:pt-16 lg:pt-20">
            <div class="mb-10">
                <li class="flex items-center dark:text-white">
                    @if ($document->category)
                        <a href="{{ route('prezet.show', ['slug' => strtolower($document->category)]) }}">
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
                    <a href="#author">
                        <span class="hover:text-primary transition-all duration-300">
                            {{ $author['name'] }}
                        </span>
                    </a>
                </div>
            </div>

            <div class="col-span-12 xl:col-span-10 xl:col-start-2 2xl:col-span-10 2xl:col-start-2"></div>

            {{-- Main Content --}}
            <div class="col-span-12 lg:col-span-9 xl:col-span-8 xl:col-start-2 2xl:col-span-7 2xl:col-start-2">
                {{-- prose-pre:-mx-8 prose-pre:rounded-none --}}
                <article
                    class="prose-pre:rounded-xl prose-headings:font-display prose prose-green prose-a:border-b prose-a:border-dashed prose-a:border-black/30 prose-a:font-semibold prose-a:no-underline prose-a:hover:border-solid prose-img:rounded-sm dark:prose-invert max-w-none"
                >
                    {!! $body !!}
                </article>

                <div class="border-dark/5 my-10 flex flex-col justify-start gap-y-5 border-t pt-10">
                    @if ($document->frontmatter->tags)
                        <ul class="flex flex-wrap items-center gap-2 sm:gap-3">
                            <li>
                                @foreach ($document->frontmatter->tags as $tag)
                                    <a
                                        href="{{ route('prezet.index', ['tag' => strtolower($tag)]) }}"
                                        class="inline-flex items-center rounded-md bg-gray-50 px-3 py-1.5 text-xs text-gray-800 ring-1 ring-gray-500/10 transition ring-inset hover:bg-gray-200 dark:bg-[#1a1a1a] dark:text-gray-200 dark:ring-[#3E3E3A] dark:hover:bg-gray-800"
                                    >
                                        <x-prezet.icon-tag class="mr-1 h-3 w-3" />

                                        {{ $tag }}
                                    </a>
                                @endforeach
                            </li>
                        </ul>
                    @endif
                </div>
                <x-author :author="$author" :document="$document" />
            </div>
        </div>
    </x-prezet.alpine>
    <div class="mx-auto my-12 w-full max-w-4xl sm:my-16 lg:my-20">
        <x-newsletter.inline />
    </div>
</x-prezet.template>
