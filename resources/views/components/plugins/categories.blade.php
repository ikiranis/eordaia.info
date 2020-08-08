<x-plugin>
    <x-slot name="label">
        <span>Κατηγορίες</span>
    </x-slot>

    @foreach ($categories as $category)
        <div>
            <a href="{{ route('category', '') . '/' . $category->slug }}">
                {{ $category->name }}
            </a>
        </div>
    @endforeach
</x-plugin>
