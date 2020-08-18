{{--<x-posts.imageModal :photo="$post->photos()->first()" />--}}

<article>

    <div class="listLabel mb-2 text-center text-md-left">
        <x-posts.categories class="mx-3" :post="$post" />
    </div>

    <div class="row">
        <x-posts.CoverPhoto
            :photo="$post->photos->first()"
            :smallPhoto="false"
            :singlePost="true"
            :title="$post->title"
        />
    </div>

    <div class="title-container mb-2">
        <div>
            <span title="Τελευταία ενημέρωση: {{ $post->updated_at->diffForHumans() }}"
                  class="post-date ml-auto col">{{ $post->updated_at->format('d/m/Y @ H:i') }}</span>
        </div>

        <div class="px-3">
            <a href="{{route('post', $post->slug)}}">
                <span class="post-title">{{$post->title}}</span>
            </a>
        </div>

        <x-posts.tags class="col-12" :post="$post" />

    </div>

    <div class="post-content px-3">

        {!! $post->markdownBody !!}

        @if($post->videos->isNotEmpty())
            <x-Youtube :url="$post->videos->first()->url" />
        @endif

        <x-posts.links :post="$post" />

    </div>

    <x-posts.related :post="$post" />

{{--    <x-error :errors="$errors" />--}}

</article>
