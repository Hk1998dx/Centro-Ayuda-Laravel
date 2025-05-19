<?php

namespace App\Livewire;

use App\Models\FaqEntry;
use Livewire\Component;

class FaqShow extends Component
{
    public FaqEntry $faq;
    public $score = null;

    public function mount(FaqEntry $faq)
    {
        $this->faq = $faq;
        $this->faq->increment('views');
    }

    public function rate()
    {
        $this->validate([
            'score' => 'required|integer|min:1|max:5'
        ]);

        $totalScore = ($this->faq->score * $this->faq->score_count) + $this->score;
        $this->faq->score_count += 1;
        $this->faq->score = $totalScore / $this->faq->score_count;
        $this->faq->save();

        session()->flash('message', '¡Gracias por tu valoración!');
    }

    public function render()
    {
        return view('livewire.faq-show')->layout('layouts.app');
    }
}

