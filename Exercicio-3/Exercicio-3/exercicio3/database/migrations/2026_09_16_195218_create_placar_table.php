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
        Schema::create('jogadores', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->timestamps();
        });

        Schema::create('placars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jogador_id')->constrained('jogadores');
            $table->integer('pontuacao');
            $table->timestamps();
        });

        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamps();
        });

        Schema::create('palavras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->string('nome');
            $table->timestamps();
        });

        Schema::create('partida', function (Blueprint $table) {
            $table->id();
            $table->foreignId('palavra_id')->constrained('palavras');
            $table->timestamps();
        });

        Schema::create('jogadores_partida', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jogador_id')->constrained('jogadores');
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
        Schema::dropIfExists('placars');
        Schema::dropIfExists('jogadores');
    }
};
