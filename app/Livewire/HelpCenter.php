<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\FaqEntry;
use App\Models\UserQuestion;

class HelpCenter extends Component
{
    public $search = '';  // Para la búsqueda
    public $title = '';  // Título de la pregunta
    public $details = '';  // Detalles de la pregunta

    // Método de búsqueda manual cuando el usuario hace clic en "Buscar"
    public function searchFaqs()
    {
        $this->render();  // Esto actualizará los resultados de búsqueda
    }

    public function render()
    {
        // Obtener las 3 preguntas más útiles basadas en la puntuación
        $bestRated = FaqEntry::orderBy('score', 'desc')->take(3)->get();

        // Obtener las 3 preguntas más vistas
        $mostViewed = FaqEntry::orderBy('views', 'desc')->take(3)->get();

        // Buscar preguntas si hay término de búsqueda
        $resultsFaq = FaqEntry::when($this->search, function ($query) {
            $query->where('question', 'like', '%' . $this->search . '%');
        })->get();

        // Buscar preguntas de los usuarios si hay término de búsqueda
        $resultsUserQuestions = UserQuestion::when($this->search, function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%');
        })->get();

        // Unir ambos resultados (FAQs y preguntas de usuario)
        $results = $resultsFaq->merge($resultsUserQuestions);

        return view('livewire.help-center', compact('bestRated', 'mostViewed', 'results'))
            ->layout('layouts.app');  // Aseguramos que el layout sea 'layouts.app'
    }

    // Método para guardar una nueva pregunta
    public function saveQuestion()
    {
        $this->validate([
            'title' => 'required|min:5',
            'details' => 'nullable|min:5',
        ]);

        // Guardamos la pregunta del usuario en la base de datos
        UserQuestion::create([
            'title' => $this->title,
            'details' => $this->details,
            'user_id' => auth()->id(),  // Asociamos la pregunta al usuario actual
        ]);

        // Limpiamos los campos del formulario después de enviarlo
        $this->reset(['title', 'details']);

        session()->flash('message', 'Pregunta enviada con éxito. ¡Gracias!');
    }
}



