<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\FaqEntry;
use App\Models\UserQuestion;

class FaqIndex extends Component
{
    public $search = '';  // Para la búsqueda

    public function render()
    {
        // Obtener las FAQs paginadas
        $faqs = FaqEntry::paginate(10);  // Aquí estamos utilizando paginate para obtener solo 10 FAQs por página

        // Obtener las preguntas de los usuarios paginadas
        $userQuestions = UserQuestion::paginate(10);  // También paginamos las preguntas de usuarios

        // Filtrar las FAQs si hay término de búsqueda
        if ($this->search) {
            $faqs = FaqEntry::where('question', 'like', '%' . $this->search . '%')->paginate(10);  // Paginación aplicada a la búsqueda
            $userQuestions = UserQuestion::where('title', 'like', '%' . $this->search . '%')->paginate(10);  // Paginación aplicada a la búsqueda
        }

        return view('livewire.admin.faq-index', compact('faqs', 'userQuestions'))
            ->layout('layouts.app');  // Asegúrate de que el layout se llama 'layouts.app'
    }

    // Método para eliminar una FAQ
    public function delete($id)
    {
        $faq = FaqEntry::findOrFail($id);
        $faq->delete();

        session()->flash('message', 'FAQ eliminada con éxito.');
    }

    // Método para eliminar una pregunta de usuario
    public function deleteUserQuestion($id)
    {
        $question = UserQuestion::findOrFail($id);
        $question->delete();

        session()->flash('message', 'Pregunta del usuario eliminada con éxito.');
    }
}



