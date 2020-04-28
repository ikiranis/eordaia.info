@if(!$post->categories()->get()->isEmpty())
    <div class="row mt-3">
        @foreach($post->categories()->get() as $category)
            <a href="{{ route('category', '') . '/' . $category->slug }}" class="badge badge-success text-light mx-1">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
@endif
