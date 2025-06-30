<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Kategoriyi Düzenle
        </h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('categories.update', $category->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block font-semibold">Kategori Adı</label>
                <input type="text" name="name" id="name"
                       class="w-full border p-2 rounded"
                       value="{{ old('name', $category->name) }}" required>

                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                Güncelle
            </button>
        </form>
    </div>
</x-app-layout>
