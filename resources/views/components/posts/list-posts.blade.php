@foreach($posts as $post)
    <x-posts.imageModal :post="$post" xmlns="http://www.w3.org/1999/html"/>

    <article class="mb-5">
{{--                <img src="img/travel/unsplash-2.jpg" class="img-responsive" />--}}
            <x-posts.CoverPhoto
                    :photo="$post->photos()->first()"
                    :postId="$post->id"
                    :smallPhoto="false" />

            <div class="title-container">
                <span title="Τελευταία ενημέρωση: {{$post->updated_at}}"
                      class="post-date ml-auto">{{ $post->updated_at->diffForHumans() }}</span>

                <a href="{{route('post', $post->slug)}}">
                    <h2 class="post-title">{{$post->title}}</h2>
                </a>
            </div>


{{--                        <x-posts.categories :post="$post" />--}}
{{--                        <x-posts.tags :post="$post" />--}}
            <div class="post-content">

                @php ($moreButton = '<div class="row col-12">
                    <a class="ml-auto" href="'. route('post', $post->slug) . '">
                        <span class="btn btn-light-secondary text-light">Συνέχεια...</span>
                    </a>
                </div>')

{{--                TODO clear text format --}}
                {!! Str::words($post->markdownBody, 20, $moreButton) !!}

{{--                <x-posts.links :post="$post" />--}}

            </div>

    </article>
@endforeach
