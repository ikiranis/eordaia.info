@foreach($posts as $post)

    <article class="list-post-container mt-3 mb-5">

            <div class="row mb-2">
                <x-posts.CoverPhoto
                    :photo="$post->cover"
                    :smallPhoto="true"
                    :singlePost="false"
                    :title="$post->title"
                />
            </div>

            <div class="title-container px-3">
                <span title="Τελευταία ενημέρωση: {{ $post->updated_at->diffForHumans() }}"
                      class="post-date ml-auto">{{ $post->updated_at->format('d/m/Y @ H:i') }}</span>

                <a href="{{route('post', $post->slug)}}">
                    <p class="post-title">{{$post->title}}</p>
                </a>
            </div>

            <div class="post-content px-3">

                @php ($moreButton = '<div class="row px-3 py-3">
                    <a class="ml-auto" href="'. route('post', $post->slug) . '">
                        <span class="btn-sm btn-light-secondary text-light">Συνέχεια...</span>
                    </a>
                </div>')

                <div class="pb-3">
                    {!! Str::words(strip_tags($post->markdownBody), 50, $moreButton) !!}
                </div>

            </div>

    </article>
@endforeach
