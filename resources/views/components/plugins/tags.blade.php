<x-plugin>
    <x-slot name="label">
        <span>Ετικέτες</span>
    </x-slot>

    <div class="text-center">
        @foreach ($tags as $tag)
            <span class="mx-1">
                <a href="{{ route('tag', '') . '/' . $tag->slug }}">
                    {{ $tag->name }}
                </a>
            </span>
        @endforeach
    </div>
</x-plugin>
