<div class="max-w-6xl mx-auto px-4 py-8 space-y-6 text-gray-800 dark:text-gray-100">
    <a href="{{ route('admin.faqs') }}" class="text-sm text-lime-600 dark:text-lime-400 hover:underline">&larr; Volver al Centro de Ayuda</a>

    <h1 class="text-3xl font-bold">{{ $question->title }}</h1>

    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow border border-gray-300 dark:border-gray-700">
        <p class="text-lg">{{ $question->details }}</p>
        <div class="text-sm text-gray-500 dark:text-gray-400 mt-4">
            {{ $question->created_at->diffForHumans() }}
        </div>
    </div>

    {{-- Formulario para la respuesta --}}
    <div class="bg-white dark:bg-gray-900 p-6 rounded shadow border border-gray-300 dark:border-gray-700">
        <h2 class="text-xl font-semibold mb-4">Respuesta</h2>

        @if (session()->has('message'))
            <div class="mb-4 text-green-600 dark:text-green-400">{{ session('message') }}</div>
        @endif

        <form wire:submit.prevent="saveAnswer" class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">Respuesta</label>
                <textarea wire:model.defer="answer" rows="6"
                          class="w-full px-4 py-2 rounded border bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-lime-500" required></textarea>
                @error('answer') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="mt-2 bg-lime-600 hover:bg-lime-700 text-white px-4 py-2 rounded">
                Enviar respuesta
            </button>
        </form>
    </div>
</div>
