<x-posts.imageModal :post="$post" />

<article>

    <x-posts.categories :post="$post" />

    <div class="row">
        <x-posts.CoverPhoto
            :photo="$post->photos()->first()"
            :postId="$post->id"
            :smallPhoto="false" />
    </div>

    <div class="title-container px-3">
        <div class="row">
            <span title="Τελευταία ενημέρωση: {{ $post->updated_at->diffForHumans() }}"
                  class="post-date ml-auto col">{{ $post->updated_at->format('d/m/Y @ H:i') }}</span>

            <x-posts.tags class="col" :post="$post" />
        </div>

        <a href="{{route('post', $post->slug)}}">
            <p class="post-title">{{$post->title}}</p>
        </a>

    </div>

    <div class="post-content px-3">

        {!! $post->markdownBody !!}

        @if(count($post->videos()->get())>0)
            <x-Youtube :url="$post->videos()->first()->url" />
        @endif

        <x-posts.links :post="$post" />

    </div>

    <x-error :errors="$errors" />

</article>
