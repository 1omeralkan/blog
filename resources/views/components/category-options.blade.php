@foreach ($categories as $category)
    <option value="{{ $category->id }}" {{ $selectedId == $category->id ? 'selected' : '' }}>
        {!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level) !!}{{ $category->name }}
    </option>

    @if ($category->children && $category->children->count())
        @include('components.category-options', [
            'categories' => $category->children,
            'level' => $level + 1,
            'selectedId' => $selectedId
        ])
    @endif
@endforeach
