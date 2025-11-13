<div>
    <h1>
        {{ $page->frontmatter->title }}
    </h1>
    <img
        src="{{ route('prezet.image', ['path' => $page->frontmatter->image]) }}"
        alt="{{ $page->frontmatter->title }}"
    />
    <div class="prose">
        {!! $page->content !!}
    </div>
</div>
