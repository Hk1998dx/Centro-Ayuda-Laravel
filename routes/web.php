<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\HelpCenter;
use App\Livewire\FaqShow;
use App\Livewire\Admin\FaqIndex;
use App\Livewire\Admin\FaqForm;
use App\Livewire\Admin\UserQuestionShow;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Ruta para la vista pública de ayuda
Route::get('/ayuda', HelpCenter::class)->name('ayuda');
Route::get('/ayuda/{faq}', FaqShow::class)->name('faq.show');
// Ruta para la vista de preguntas de los usuarios
Route::get('/user-question/{question}', \App\Livewire\UserQuestionShow::class)
    ->name('user-question.show');  // Vista solo para ver la pregunta

// Ruta para el panel de administración de FAQs
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/faqs', FaqIndex::class)
        ->name('admin.faqs');

    Route::get('/admin/faqs/create', FaqForm::class)
        ->name('admin.faqs.create');
        
    Route::get('/admin/faqs/{faq}/edit', FaqForm::class)
        ->name('admin.faqs.edit');
    
    // Ruta para la vista de preguntas de los usuarios
    Route::get('/admin/user-questions/{question}', UserQuestionShow::class)
        ->name('admin.user-question.show');
});
