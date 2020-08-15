<x-plugin>
    <x-slot name="label">
        <span>Ετικέτες</span>
    </x-slot>

    <div class="tags">
        @foreach ($tags as $tag)
            <span class="mr-1">
                <a href="{{ route('tag', '') . '/' . $tag->slug }}">
                    <span class="tag-size-{{ $tag->size }}">{{ $tag->name }}</span>
                </a>
            </span>
        @endforeach
    </div>
</x-plugin>
