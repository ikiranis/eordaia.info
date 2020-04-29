<x-posts.imageModal :post="$post" />

<div class="col-12 my-3">

    <div class="row">
        <div class="col-12 text-right">
            <h2 class="text-center"><a href="{{route('post', $post->slug)}}">{{$post->title}}</a></h2>
            <div>{{ $post->author !== null ? 'Από: '. $post->author : '' }}</div>
            <div title="Τελευταία ενημέρωση: {{$post->updated_at}}">{{$post->updated_at->diffForHumans()}}</div>
        </div>

    </div>

    <div>
        <div class="row my-3">
            <div class="col-md-4 col-12">
{{--                <img src="{{$post->photo ? $post->photo->fullPathName : 'http://via.placeholder.com/350x150'}}"--}}
{{--                     class="card-img btn" data-toggle="modal" data-target="#imageModal{{ $post->id }}">--}}

                <ul class="list-group my-2">
                    @if(count($post->tags()->get())>0)
                        <div id="tagsContainer{{$post->id}}">
                            <li class="list-group-item list-group-item-action">
                                @include('includes.tags.tags-list')
                            </li>
                        </div>
                    @endif
                </ul>

                {{--<div class="row my-2">--}}
                {{--@include('includes.social-buttons')--}}
                {{--</div>--}}

            </div>
            <div class="col-md-8 col-12 text-justify article">
                {!! $post->body !!}

{{--                @include('includes.reference-link')--}}

            </div>


        </div>

{{--        @include('includes.ads.post-google-ad')--}}

    </div>

    <x-error :errors="$errors" />

</div>
