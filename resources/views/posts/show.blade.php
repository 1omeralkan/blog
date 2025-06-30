<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-8">

                {{-- 🔽 Post görseli (varsa) --}}
                @if ($post->image)
                    <div class="mb-6">
                        <img src="{{ asset('storage/images/' . $post->image) }}"
                             alt="Post Görseli"
                             class="w-full max-h-[500px] object-cover rounded shadow">
                    </div>
                @endif
                @if ($post->image_path)
    <div class="mb-6 text-center">
        <img src="{{ asset('storage/' . $post->image_path) }}"
             alt="Post Görseli"
             class="mx-auto rounded shadow max-w-[500px] max-h-[400px] object-contain">
    </div>
@endif


                {{-- İçerik --}}
                <div class="prose dark:prose-invert max-w-full text-lg leading-relaxed text-gray-800 dark:text-gray-200">
                    {!! nl2br(e($post->content)) !!}
                </div>

                {{-- Bilgiler --}}
                <div class="mt-6 text-sm text-gray-500 dark:text-gray-400 space-y-1">
                    <p>✍️ Yazar: <strong>{{ $post->user->name }}</strong></p>
                    <p>📅 Oluşturulma: {{ $post->created_at->format('d.m.Y H:i') }}</p>
                    <p>📂 Kategori: 
                        <span class="inline-block bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300 px-2 py-1 rounded text-xs">
                            {{ $post->category->name ?? 'Kategori Yok' }}
                        </span>
                    </p>
                </div>

                {{-- Geri dön --}}
                <a href="{{ route('posts.index') }}" 
                   class="mt-6 inline-block text-blue-600 dark:text-blue-400 hover:underline">
                    ← Tüm Yazılara Dön
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
