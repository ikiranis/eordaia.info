@if(!$post->links()->get()->isEmpty())
    <div class="row my-3">
        <a href="{{ $post->links()->first()->url }}" class="ml-auto mr-auto" title="{{ $post->links()->first()->url }}">
            <span class="btn btn-outline-info">Περισσότερα στο <strong>{{ parse_url($post->links()->first()->url)['host'] }}</strong></span>
        </a>
    </div>
@endif
