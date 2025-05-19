<?php

namespace App\Livewire\Admin;

use App\Models\UserQuestion;
use Livewire\Component;

class UserQuestionShow extends Component
{
    public $question;
    public $answer;

    // Este método se ejecutará cuando el componente sea montado
    public function mount(UserQuestion $question)
    {
        $this->question = $question;
        $this->answer = $question->answer; // Pre-cargar la respuesta si ya existe
    }

    // Método para guardar la respuesta
    public function saveAnswer()
    {
        $this->validate([
            'answer' => 'required|string|min:5',
        ]);

        $this->question->answer = $this->answer;
        $this->question->save();

        session()->flash('message', 'Respuesta enviada con éxito.');
    }

    public function render()
    {
        return view('livewire.admin.user-question-show')->layout('layouts.app');
    }
}

