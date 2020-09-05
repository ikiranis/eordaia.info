<x-plugin>
    <x-slot name="label">
        <span>Ημερολόγιο</span>
    </x-slot>

    <div class="months">
        @foreach($months as $month)
            <div>
                    <a href="{{ route('month', ['year' => $month->year, 'month' => $month->month]) }}">
                    <span>{{ $names[$month->month-1] }}, {{ $month->year }}</span>
                </a>
            </div>
        @endforeach
    </div>
</x-plugin>
