@if(!$post->tags()->get()->isEmpty())
    <div class="row mt-3">
        <div class="mx-auto">
            @foreach($post->tags()->get() as $tag)
                <a href="{{ route('tag', '') . $tag.slug }}">
                    {{ $tag.name }}
                </a>
            @endforeach
        </div>
    </div>
@endif
