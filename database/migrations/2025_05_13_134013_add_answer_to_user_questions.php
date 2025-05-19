<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('user_questions', function (Blueprint $table) {
            $table->text('answer')->nullable();  // Agregar columna de respuesta
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('user_questions', function (Blueprint $table) {
            $table->dropColumn('answer');
        });
    }
};
