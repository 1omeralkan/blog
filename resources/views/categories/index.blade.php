<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Kategoriler
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        @if (session('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
            + Yeni Kategori
        </a>

        <table class="w-full table-auto border border-collapse mt-4">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-700">
                    <th class="border px-4 py-2 text-left">ID</th>
                    <th class="border px-4 py-2 text-left">Kategori Adı</th>
                    <th class="border px-4 py-2 text-left">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    @include('categories._category-item', ['category' => $category, 'level' => 0])
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
