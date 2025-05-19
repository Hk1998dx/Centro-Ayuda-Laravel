<div class="max-w-3xl mx-auto px-4 py-8 text-gray-800 dark:text-gray-100 space-y-6">
    <a href="{{ route('ayuda') }}" class="text-sm text-lime-600 dark:text-lime-400 hover:underline">&larr; Volver al Centro de Ayuda</a>

    <h1 class="text-3xl font-bold">{{ $faq->question }}</h1>

    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow border border-gray-300 dark:border-gray-700">
        <p class="text-lg">{{ $faq->answer }}</p>
        <div class="text-sm text-gray-500 dark:text-gray-400 mt-4">
            {{ $faq->views }} vistas • Puntuación media: {{ number_format($faq->score, 2) }} ⭐
        </div>
    </div>

    {{-- Feedback de utilidad --}}
    <div class="bg-white dark:bg-gray-900 p-6 rounded shadow border border-gray-300 dark:border-gray-700">
        <h2 class="text-xl font-semibold mb-4">¿Te ha resultado útil esta respuesta?</h2>

        @if (session()->has('message'))
            <div class="mb-4 text-green-600 dark:text-green-400">{{ session('message') }}</div>
        @else
            <form wire:submit.prevent="rate" class="space-y-4">
                <div class="flex gap-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <label>
                            <input type="radio" wire:model="score" value="{{ $i }}" class="hidden">
                            <span class="cursor-pointer text-2xl {{ $score >= $i ? 'text-yellow-400' : 'text-gray-400' }}">★</span>
                        </label>
                    @endfor
                </div>
                @error('score') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

                <button type="submit" class="mt-2 bg-lime-600 hover:bg-lime-700 text-white px-4 py-2 rounded">
                    Enviar valoración
                </button>
            </form>
        @endif
    </div>
</div>

