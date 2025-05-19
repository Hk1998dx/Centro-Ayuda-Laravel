<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_questions', function (Blueprint $table) {
            $table->string('title');  // Agregar la columna 'title' de tipo string
            $table->text('details')->nullable();  // Agregar la columna 'details' de tipo text
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_questions', function (Blueprint $table) {
            $table->dropColumn('title');  // Eliminar la columna 'title'
            $table->dropColumn('details');  // Eliminar la columna 'details'
        });
    }
};

