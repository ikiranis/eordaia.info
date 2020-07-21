@foreach($posts as $post)
    <x-posts.imageModal :post="$post" xmlns="http://www.w3.org/1999/html"/>

    <article class="mt-3 mb-5 py-3 px-3">
{{--                <img src="img/travel/unsplash-2.jpg" class="img-responsive" />--}}
            <x-posts.CoverPhoto
                    :photo="$post->photos()->first()"
                    :postId="$post->id"
                    :smallPhoto="false" />

            <div class="title-container">
                <span title="Τελευταία ενημέρωση: {{ $post->updated_at->diffForHumans() }}"
                      class="post-date ml-auto">{{ $post->updated_at->format('d/m/Y @ H:i') }}</span>

                <a href="{{route('post', $post->slug)}}">
                    <p class="post-title">{{$post->title}}</p>
                </a>
            </div>


{{--                        <x-posts.categories :post="$post" />--}}
{{--                        <x-posts.tags :post="$post" />--}}
            <div class="post-content">

                @php ($moreButton = '<div class="row col-12 mt-3">
                    <a class="ml-auto" href="'. route('post', $post->slug) . '">
                        <span class="btn-sm btn-light-secondary text-light">Συνέχεια...</span>
                    </a>
                </div>')

                {!! Str::words(strip_tags($post->markdownBody), 50, $moreButton) !!}

{{--                <x-posts.links :post="$post" />--}}

            </div>

    </article>
@endforeach
