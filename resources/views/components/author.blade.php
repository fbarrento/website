@props([
    'author',
    'document',
])

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
    <div class="flex flex-col space-y-6">
        <div>
            <p class="text-[20px] font-medium text-black md:text-2xl dark:text-white">
                {{ $author['name'] }}
            </p>
            <div class="mt-2 text-gray-600 md:mt-3 dark:text-gray-400">
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
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                </svg>
            </a>
        </div>

        <div>
            @foreach ($author['social_profiles'] as $key => $profile)
                <a
                    href="{{ $profile['url'] }}"
                    class="hover:text-primary dark:hover:text-primary-dark dark:text-primary-500 mr-4 inline-block text-xl font-medium"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    @svg($profile['icon'], ['class' => 'size-5'])
                </a>
            @endforeach()
        </div>
    </div>
</div>
