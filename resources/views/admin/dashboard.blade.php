<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👑 Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Hoş Geldin, {{ auth()->user()->name }}</h1>
                <p class="text-gray-600">Buradan sistem genelini yönetebilirsin.</p>
            </div>
        </div>
    </div>
</x-app-layout>
