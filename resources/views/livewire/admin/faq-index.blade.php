<div class="max-w-6xl mx-auto px-4 py-8 space-y-6 text-gray-800 dark:text-gray-100">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Gestión de Entradas del Centro de Ayuda</h1>

    {{-- Botón para nueva entrada --}}
    <div class="flex justify-end">
        <a href="{{ route('admin.faqs.create') }}"
           class="bg-lime-600 hover:bg-lime-700 text-white px-4 py-2 rounded text-sm">
            + Nueva Entrada
        </a>
    </div>

    {{-- Mensaje de éxito --}}
    @if (session()->has('message'))
        <div class="p-4 text-green-600 bg-green-100 dark:bg-green-900 rounded">
            {{ session('message') }}
        </div>
    @endif

    {{-- Buscador --}}
    <div class="flex justify-between items-center mt-4">
        <input type="text" wire:model.debounce.300ms="search" placeholder="Buscar por pregunta..."
            class="w-full sm:w-1/3 px-4 py-2 rounded border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-lime-500" />
    </div>

    {{-- Tabla --}}
    <div class="overflow-x-auto mt-4">
        <table class="min-w-full table-auto bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded">
            <thead class="bg-gray-200 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-2 text-left">Pregunta</th>
                    <th class="px-4 py-2">Vistas</th>
                    <th class="px-4 py-2">Puntuación</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{-- Mostrar FAQs --}}
                @foreach ($faqs as $faq)
                    <tr class="border-t border-gray-200 dark:border-gray-700">
                        <td class="px-4 py-2">{{ Str::limit($faq->question, 60) }}</td>
                        <td class="px-4 py-2 text-center">{{ $faq->views }}</td>
                        <td class="px-4 py-2 text-center">{{ number_format($faq->score, 2) }}</td>
                        <td class="px-4 py-2 text-center space-x-2">
                            <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="text-blue-600 hover:underline text-sm">Editar</a>
                            <button wire:click="delete({{ $faq->id }})"
                                    onclick="return confirm('¿Eliminar esta entrada?')"
                                    class="text-red-600 hover:underline text-sm">Eliminar</button>
                        </td>
                    </tr>
                @endforeach

                {{-- Mostrar preguntas de los usuarios --}}
                @foreach ($userQuestions as $question)
                    <tr class="border-t border-gray-200 dark:border-gray-700">
                        <td class="px-4 py-2">{{ Str::limit($question->title, 60) }}</td>
                        <td class="px-4 py-2 text-center">N/A</td> <!-- No hay "vistas" para preguntas de usuarios -->
                        <td class="px-4 py-2 text-center">N/A</td> <!-- No hay "puntuación" para preguntas de usuarios -->
                        <td class="px-4 py-2 text-center space-x-2">
                            <!-- Enlace de "Ver" modificado -->
                            <a href="{{ route('admin.user-question.show', $question->id) }}" class="text-blue-600 hover:underline text-sm">Ver</a>
                            <button wire:click="deleteUserQuestion({{ $question->id }})"
                                onclick="return confirm('¿Eliminar esta pregunta?')"
                                class="text-red-600 hover:underline text-sm">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-4">
        {{ $faqs->links() }}
        {{ $userQuestions->links() }}  <!-- Paginación para las preguntas de usuarios -->
    </div>
</div>





