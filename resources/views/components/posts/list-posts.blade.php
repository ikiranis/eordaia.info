@foreach($posts as $post)
    <x-posts.imageModal :post="$post" xmlns="http://www.w3.org/1999/html"/>

    <article class="mt-3 mb-5">
{{--                <img src="img/travel/unsplash-2.jpg" class="img-responsive" />--}}

            <div class="row">
                <x-posts.CoverPhoto
                    :photo="$post->photos()->first()"
                    :postId="$post->id"
                    :smallPhoto="false" />
            </div>

            <div class="title-container py-3 px-3">
                <span title="Τελευταία ενημέρωση: {{ $post->updated_at->diffForHumans() }}"
                      class="post-date ml-auto">{{ $post->updated_at->format('d/m/Y @ H:i') }}</span>

                <a href="{{route('post', $post->slug)}}">
                    <p class="post-title">{{$post->title}}</p>
                </a>
            </div>


{{--                        <x-posts.categories :post="$post" />--}}
{{--                        <x-posts.tags :post="$post" />--}}
            <div class="post-content py-3 px-3">

                @php ($moreButton = '<div class="row mt-3 px-3">
                    <a class="ml-auto" href="'. route('post', $post->slug) . '">
                        <span class="btn-sm btn-light-secondary text-light">Συνέχεια...</span>
                    </a>
                </div>')

                {!! Str::words(strip_tags($post->markdownBody), 50, $moreButton) !!}

{{--                <x-posts.links :post="$post" />--}}

            </div>

    </article>
@endforeach
