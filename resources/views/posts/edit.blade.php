<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Yazıyı Düzenle
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('posts.update', $post->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="block font-semibold">Başlık</label>
                        <input type="text" name="title" id="title" class="w-full border p-2 rounded"
                               value="{{ old('title', $post->title) }}" required>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 🔽 Recursive Kategori Seçimi --}}
                   <div class="mb-4">
    <label for="category_id" class="block font-semibold text-gray-700 dark:text-gray-300">Kategori</label>
    <select name="category_id" id="category_id" class="w-full border p-2 rounded" required>
        <option value="">Tüm Kategoriler</option>
        @include('components.category-options', [
            'categories' => $categories,
            'level' => 0,
            'selectedId' => old('category_id', $post->category_id)
        ])
    </select>
    @error('category_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

                    

                    <div class="mb-4">
                        <label for="content" class="block font-semibold">İçerik</label>
                        <textarea name="content" id="content" rows="5" class="w-full border p-2 rounded" required>{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                        Güncelle
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
