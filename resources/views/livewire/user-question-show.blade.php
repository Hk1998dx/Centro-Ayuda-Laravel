<div class="max-w-6xl mx-auto px-4 py-8 space-y-6 text-gray-800 dark:text-gray-100">
    <a href="{{ route('ayuda') }}" class="text-sm text-lime-600 dark:text-lime-400 hover:underline">&larr; Volver al Centro de Ayuda</a>

    <h1 class="text-3xl font-bold">{{ $question->title }}</h1>

    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow border border-gray-300 dark:border-gray-700">
        <p class="text-lg">{{ $question->details }}</p>
        <div class="text-sm text-gray-500 dark:text-gray-400 mt-4">
            {{ $question->created_at->diffForHumans() }}
        </div>
    </div>

    {{-- Aquí no se permite la respuesta del usuario, solo la visualización --}}
</div>

