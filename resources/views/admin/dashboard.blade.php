<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Panel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-xl font-bold mb-4">👑 Admin Dashboard'a Hoş Geldin {{ auth()->user()->name }}</h1>
                <p class="mb-2">Buradan sistem genelini yönetebilirsin.</p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">
                    <div class="bg-blue-100 p-4 rounded">Toplam Kullanıcı: {{ $totalUsers }}</div>
                    <div class="bg-green-100 p-4 rounded">Toplam Post: {{ $totalPosts }}</div>
                    <div class="bg-yellow-100 p-4 rounded">Toplam Kategori: {{ $totalCategories }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-10">
    <h2 class="text-xl font-semibold mb-4">📝 Son Eklenen Postlar</h2>
    <div class="bg-white shadow rounded overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Başlık</th>
                    <th class="px-4 py-2">Kategori</th>
                    <th class="px-4 py-2">Tarih</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latestPosts as $post)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $post->id }}</td>
                        <td class="px-4 py-2">{{ $post->title }}</td>
                        <td class="px-4 py-2">{{ $post->category?->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $post->created_at->diffForHumans() }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-3 text-center">Henüz post eklenmemiş.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</x-app-layout>
