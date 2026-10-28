<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jogadors', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->timestamps();
        });

        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->timestamps();
        });

        Schema::create('palavras', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();

            $table->foreignId('categoria_id')->constrained('categorias')->cascadeOnDelete();

            $table->timestamps();
        });

        Schema::create('partidas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('categoria_id')->constrained('categorias');

            $table->foreignId('palavra_id')->constrained('palavras');

            $table->foreignId('jogador_atual_id')->nullable()->constrained('jogadors');

            $table->json('acertos')->nullable();
            $table->json('erros')->nullable();
            $table->timestamp('encerrada_em')->nullable();

            $table->timestamps();
        });

        Schema::create('placars', function (Blueprint $table) {
            $table->id();

            $table->foreignId('partida_id')->constrained('partidas')->cascadeOnDelete();

            $table->foreignId('jogador_id')->constrained('jogadors')->cascadeOnDelete();

            $table->integer('pontuacao')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('placars');
        Schema::dropIfExists('partidas');
        Schema::dropIfExists('palavras');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('jogadors');
    }
};