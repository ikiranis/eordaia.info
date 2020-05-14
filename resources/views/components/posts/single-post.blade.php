<x-posts.imageModal :post="$post" />

<article class="col-12 my-3">

    <div class="row">
        <div class="col-12 text-right">
            <h2 class="text-center"><a href="{{route('post', $post->slug)}}">{{$post->title}}</a></h2>
            <div>{{ $post->author !== null ? 'Από: '. $post->author : '' }}</div>
            <div title="Τελευταία ενημέρωση: {{$post->updated_at}}">{{$post->updated_at->diffForHumans()}}</div>

            <x-posts.categories :post="$post" />
            <x-posts.tags :post="$post" />
        </div>

    </div>

    <div>
        <div class="row my-3">
            @if ($post->photos()->first())
                <div class="col-md-4 col-12">
                    <img src="{{ $post->photos()->first()->photoUrl ? $post->photos()->first()->photoUrl : '' }}"
                         class="card-img btn" data-toggle="modal" data-target="#imageModal{{ $post->id }}">
                </div>
            @endif

            <div class="col-md-8 col-12 text-justify article">
                {!! $post->markdownBody !!}

                <x-posts.links :post="$post" />

            </div>


        </div>

        {{--        @include('includes.ads.post-google-ad')--}}

    </div>

    <x-error :errors="$errors" />

</article>
