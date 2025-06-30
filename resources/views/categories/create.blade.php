<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Yeni Kategori Ekle
        </h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            {{-- Kategori Adı --}}
            <div class="mb-4">
                <label for="name" class="block font-semibold">Kategori Adı</label>
                <input type="text" name="name" id="name"
                       class="w-full border p-2 rounded"
                       value="{{ old('name') }}" required>

                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Üst Kategori Seçimi --}}
            <div class="mb-4">
                <label for="parent_id" class="block font-semibold">Üst Kategori (isteğe bağlı)</label>
                <select name="parent_id" id="parent_id" class="w-full border p-2 rounded">
    <option value="">Ana Kategori</option>
    @include('components.category-options', [
        'categories' => $categories,
        'level' => 0,
        'selectedId' => old('parent_id')
    ])
</select>


                @error('parent_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Kaydet
            </button>
        </form>
    </div>
</x-app-layout>
