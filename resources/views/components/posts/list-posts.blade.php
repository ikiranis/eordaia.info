@foreach($posts as $post)
    <x-posts.imageModal :post="$post" />

    <article class="col-12 my-3">
        <div class="card">
            <div class="card-header row no-gutters">
                <div class="col-lg-9 col-12 my-auto">
                    <h3><a href="{{route('post', $post->slug)}}">{{$post->title}}</a></h3>

                    <x-posts.categories :post="$post" />
                    <x-posts.tags :post="$post" />
                </div>
                <div class="col-lg-3 col-12 ml-auto text-right my-auto">
                    <div>{{ $post->author !== null ? 'Από: '. $post->author : '' }}</div>
                    <div title="Τελευταία ενημέρωση: {{$post->updated_at}}">{{$post->updated_at->diffForHumans()}}</div>
                </div>
            </div>

            <div class="card-body">

                <div class="row my-3">
                    <x-posts.CoverPhoto
                            :photo="$post->photos()->first()"
                            :postId="$post->id"
                            :smallPhoto="true" />

                    <div class="col-md-8 col-12 article">
                        @php ($moreButton = ' [...] <div class="row"><a href="'. route('post', $post->slug). '" class="mx-5 btn btn-sm btn-outline-secondary">Συνέχεια...</a></div>')

                        {!! Str::words($post->markdownBody, 200, $moreButton) !!}

                        <x-posts.links :post="$post" />
                    </div>
                </div>
            </div>

        </div>
    </article>
@endforeach
