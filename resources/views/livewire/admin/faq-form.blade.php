<div class="max-w-3xl mx-auto px-4 py-8 space-y-6 text-gray-800 dark:text-gray-100">
    <h1 class="text-2xl font-bold">
        {{ $faqId ? 'Editar Entrada' : 'Nueva Entrada' }}
    </h1>

    @if (session()->has('message'))
        <div class="p-4 text-green-600 bg-green-100 dark:bg-green-900 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
        <div>
            <label for="question" class="block text-sm font-medium mb-1">Pregunta</label>
            <input type="text" id="question" wire:model.defer="question"
                class="w-full px-4 py-2 rounded border bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-lime-500" required>
            @error('question') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="answer" class="block text-sm font-medium mb-1">Respuesta</label>
            <textarea id="answer" wire:model.defer="answer" rows="6"
                class="w-full px-4 py-2 rounded border bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-lime-500" required></textarea>
            @error('answer') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('admin.faqs') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:underline">← Volver</a>
            <button type="submit" class="bg-lime-600 hover:bg-lime-700 text-white px-4 py-2 rounded">
                Guardar
            </button>
        </div>
    </form>
</div>
