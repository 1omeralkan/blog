@php use Illuminate\Support\Str; @endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Tüm Yazılar
        </h2>
    </x-slot>

    {{-- 🔍 Arama ve Filtreleme Formu --}}
    <div class="max-w-4xl mx-auto mb-6">
        <form method="GET" action="{{ route('posts.index') }}" class="flex gap-4 items-center">
            {{-- Arama --}}
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Başlıkta Ara..." class="w-full border rounded p-2" />

            {{-- Kategori --}}
            <select name="category_id" class="border rounded p-2">
    <option value="">Tüm Kategoriler</option>
    @include('components.category-options', [
        'categories' => $categories,
        'level' => 0,
        'selectedId' => request('category_id')
    ])
</select>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Filtrele
            </button>
        </form>
    </div>

    {{-- 📄 Yazı Listesi --}}
    <div class="py-6 max-w-4xl mx-auto">
        @foreach ($posts as $post)
            <div class="mb-6 p-4 border rounded">
                @if ($post->image_path)
    <img src="{{ asset('storage/' . $post->image_path) }}" 
         alt="Post Görseli" 
         class="w-40 h-40 object-cover rounded shadow mb-2">
@endif

                <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                <p>{{ Str::limit($post->content, 100) }}</p>
                <p class="text-sm text-gray-500">Yazar: {{ $post->user->name ?? 'Bilinmiyor' }}</p>
                <p class="text-sm text-gray-500">Kategori: {{ $post->category->name ?? 'Kategori yok' }}</p>

                <div class="flex gap-4 mt-2">
                    <a href="{{ route('posts.show', $post->id) }}" class="text-blue-600 hover:underline">
                        Devamını oku
                    </a>

                    <a href="{{ route('posts.edit', $post->id) }}" class="text-yellow-600 hover:underline">
                        Düzenle
                    </a>

                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                          onsubmit="return confirm('Silmek istediğine emin misin?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">
                            Sil
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
