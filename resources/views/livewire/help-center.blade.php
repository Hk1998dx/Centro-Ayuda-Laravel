<div class="max-w-6xl mx-auto px-4 py-8 space-y-12 text-gray-800 dark:text-gray-100">
    <h1 class="text-3xl font-bold text-center">Centro de Ayuda</h1>

    {{-- 🔍 Buscador --}}
    <div class="flex justify-center mt-6 space-x-4">
        <input type="text"
               wire:model.debounce.500ms="search"
               placeholder="Buscar una pregunta..."
               class="w-full sm:w-1/2 px-4 py-2 rounded border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-lime-500"
        />
        <!-- Botón de búsqueda -->
        <button 
            wire:click="searchFaqs"
            class="px-4 py-2 bg-lime-600 hover:bg-lime-700 text-white rounded">
            Buscar
        </button>
    </div>

    {{-- ⭐ Preguntas mejor valoradas --}}
    <div>
        <h2 class="text-2xl font-semibold mb-4">Las más útiles</h2>
        <div class="grid md:grid-cols-3 gap-4">
            @foreach ($bestRated as $faq)
                <div class="p-4 border border-gray-300 dark:border-gray-700 rounded shadow hover:shadow-lg transition bg-white dark:bg-gray-800">
                    <h3 class="font-bold">{{ $faq->question }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">Puntuación: {{ number_format($faq->score, 2) }} ⭐</p>
                    <a href="{{ route('faq.show', $faq->id) }}" class="text-lime-600 dark:text-lime-400 underline text-sm mt-3 inline-block">Ver más</a>
                </div>
            @endforeach
        </div>
    </div>

    {{-- 👁️ Preguntas más vistas --}}
    <div>
        <h2 class="text-2xl font-semibold mb-4">Más vistas</h2>
        <div class="grid md:grid-cols-3 gap-4">
            @foreach ($mostViewed as $faq)
                <div class="p-4 border border-gray-300 dark:border-gray-700 rounded shadow hover:shadow-lg transition bg-white dark:bg-gray-800">
                    <h3 class="font-bold">{{ $faq->question }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">Vistas: {{ $faq->views }}</p>
                    <a href="{{ route('faq.show', $faq->id) }}" class="text-lime-600 dark:text-lime-400 underline text-sm mt-3 inline-block">Ver más</a>
                </div>
            @endforeach
        </div>
    </div>

    {{-- 📋 Resultados por búsqueda --}}
    @if($search)
        <div>
            <h2 class="text-2xl font-semibold mb-4">Resultados para "{{ $search }}"</h2>
            <ul class="space-y-3">
                @forelse ($results as $item)
                    <li class="border-b border-gray-300 dark:border-gray-700 pb-2">
                        <h3 class="font-medium">{{ $item->question ?? $item->title }}</h3>
                        <!-- Condicional para redirigir a la vista de FAQ o de pregunta de usuario -->
                        @if (isset($item->question)) <!-- Si es FAQ -->
                            <a href="{{ route('faq.show', $item->id) }}" class="text-sm text-lime-600 dark:text-lime-400">Ver más</a>
                        @else <!-- Si es una pregunta de usuario -->
                            <a href="{{ route('user-question.show', $item->id) }}" class="text-sm text-lime-600 dark:text-lime-400">Ver más</a>
                        @endif
                    </li>
                @empty
                    <li>No se encontraron resultados.</li>
                @endforelse
            </ul>
        </div>
    @endif

    {{-- 📝 Formulario para dejar una pregunta --}}
    <div class="bg-white dark:bg-gray-900 p-6 rounded shadow border border-gray-300 dark:border-gray-700">
        <h2 class="text-xl font-semibold mb-4">¿No encontraste lo que buscabas?</h2>
        @if (session()->has('message'))
            <div class="mb-4 text-green-600 dark:text-green-400">{{ session('message') }}</div>
        @endif
        <form wire:submit.prevent="saveQuestion" class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">Título</label>
                <input type="text" wire:model.defer="title" class="w-full px-4 py-2 rounded border bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-lime-500" required>
                @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Detalles</label>
                <textarea wire:model.defer="details" rows="3" class="w-full px-4 py-2 rounded border bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-lime-500"></textarea>
                @error('details') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="bg-lime-600 hover:bg-lime-700 text-white px-4 py-2 rounded">
                Enviar pregunta
            </button>
        </form>
    </div>
</div>






