@if(!$post->links()->get()->isEmpty())
    <div class="row mt-3">
        <div class="mx-auto">
            @foreach($post->links()->get() as $link)
                <a href="{{ $link->url }}" class="btn btn-sm btn-outline-info mx-1" title="{{ $link->url }}">
                    <span>{{ parse_url($link->url)['host'] }}</span>
                </a>
            @endforeach
        </div>
    </div>
@endif
