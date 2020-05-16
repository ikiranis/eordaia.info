@foreach($posts as $post)
    <x-posts.imageModal :post="$post" xmlns="http://www.w3.org/1999/html"/>

    <section class="col-12 my-3">
        <article class="blog-post">
            <div class="panel panel-default">
{{--                <img src="img/travel/unsplash-2.jpg" class="img-responsive" />--}}
                <x-posts.CoverPhoto
                        :photo="$post->photos()->first()"
                        :postId="$post->id"
                        :smallPhoto="false" />
                <div class="panel-body">
                    <div class="blog-post-meta">
                        <span class="label label-light label-success">{{ $post->author !== null ? 'Από: '. $post->author : 'Unknown' }}</span>
                        <p title="Τελευταία ενημέρωση: {{$post->updated_at}}"
                           class="blog-post-date pull-right">{{$post->updated_at->diffForHumans()}}</p>

{{--                        <x-posts.categories :post="$post" />--}}
{{--                        <x-posts.tags :post="$post" />--}}
                    </div>
                    <div class="blog-post-content">
                        <a href="{{route('post', $post->slug)}}">
                            <h2 class="blog-post-title">{{$post->title}}</h2>
                        </a>

                        @php ($moreButton = ' [...] <a class="btn btn-info" href="'. route('post', $post->slug) . '>Συνέχεια...</a></div>')

                        {!! Str::words($post->markdownBody, 200, $moreButton) !!}

{{--                        <x-posts.links :post="$post" />--}}

                        <a class="blog-post-share pull-right" href="#">
                            <i class="material-icons">&#xE80D;</i>
                        </a>
                    </div>
                </div>
            </div>
        </article>
    </section>
@endforeach
