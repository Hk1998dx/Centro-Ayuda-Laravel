<?php

namespace App\Livewire\Admin;

use App\Models\FaqEntry;
use Livewire\Component;

class FaqForm extends Component
{
    public $faqId = null;
    public $question = '';
    public $answer = '';

    public function mount($faq = null)
    {
        // Si recibimos un ID
        if (is_numeric($faq)) {
            $this->faqId = $faq;
            $faq = FaqEntry::findOrFail($this->faqId);
        }

        // Si tenemos un modelo (ya sea por inyección o por búsqueda)
        if ($faq instanceof FaqEntry) {
            $this->question = $faq->question;
            $this->answer = $faq->answer;
            $this->faqId = $faq->id;
        }
    }

    public function save()
    {
        $data = $this->validate([
            'question' => 'required|string|min:5',
            'answer' => 'required|string|min:5',
        ]);

        // Si estamos editando
        if ($this->faqId) {
            $faq = FaqEntry::findOrFail($this->faqId);
            $faq->update($data);
            session()->flash('message', 'Entrada actualizada correctamente.');
        } else {
            // Crear una nueva FAQ
            FaqEntry::create($data);
            session()->flash('message', 'Entrada creada con éxito.');
        }

        return redirect()->route('admin.faqs');
    }

    public function render()
    {
        return view('livewire.admin.faq-form')->layout('layouts.app');
    }
}



