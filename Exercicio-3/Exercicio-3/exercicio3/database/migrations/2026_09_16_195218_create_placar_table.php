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
        Schema::create('jogador', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->timestamps();
        });

        Schema::create('placar', function (Blueprint $table) {
            $table->id();
            $table->integer('pontuacao');
            $table->foreignId('jogador_id')->constrained('jogador');
            $table->timestamps();
        });

        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamps();
        });

        Schema::create('palavras', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->timestamps();
        });

        Schema::create('partida', function (Blueprint $table) {
            $table->id();
            $table->foreignId('palavras_id')->constrained('palavras');
            $table->timestamps();
        });

        Schema::create('jogadores_partida', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jogador_id')->constrained('jogador');
            $table->foreignId('partida_id')->constrained('partida');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jogadores_partida');
        Schema::dropIfExists('partida');
        Schema::dropIfExists('palavras');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('placar');
        Schema::dropIfExists('jogador');
    }
};
