<?php

namespace App\Livewire;

use App\Models\UserQuestion;
use Livewire\Component;

class UserQuestionShow extends Component
{
    public $question;

    public function mount(UserQuestion $question)
    {
        $this->question = $question;
    }

    public function render()
    {
        return view('livewire.user-question-show')->layout('layouts.app');
    }
}

