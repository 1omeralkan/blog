<tr>
    <td class="border px-4 py-2">{{ $category->id }}</td>

    {{-- Kategori adı: iç içe görünüm için girinti boşluğu ve icon --}}
    <td class="border px-4 py-2">
        {!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level) !!}
        @if ($level > 0) └─ @endif
        {{ $category->name }}
    </td>

    <td class="border px-4 py-2">
        <a href="{{ route('categories.edit', $category->id) }}" class="text-yellow-600 hover:underline mr-4">Düzenle</a>

        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block"
              onsubmit="return confirm('Bu kategoriyi silmek istediğine emin misin?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:underline">Sil</button>
        </form>
    </td>
</tr>

{{-- Recursive olarak alt kategorileri göster --}}
@if ($category->children && $category->children->count())
    @foreach ($category->children as $child)
        @include('categories._category-item', ['category' => $child, 'level' => $level + 1])
    @endforeach
@endif
