<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_questions', function (Blueprint $table) {
            $table->id();
            $table->string('title');    // título o asunto de la pregunta
            $table->text('details');    // explicación o desarrollo
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_questions');
    }
};

