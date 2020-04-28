@if(!$post->tags()->get()->isEmpty())
    <div class="row mt-3">
        @foreach($post->tags()->get() as $tag)
            <a href="{{ route('tag', '') . '/' . $tag->slug }}" class="badge badge-primary text-light mx-1">
                {{ $tag->name }}
            </a>
        @endforeach
    </div>
@endif
