@props(['acertos', 'erros', 'partida', 'perdeu' => false])

@php
    $vencedor = $partida->placares->sortByDesc('pontuacao')->first();
    $perdedor = $partida->placares->firstWhere('id', '!=', $vencedor->id);

    $estatisticas = [
        'Acertos' => $acertos,
        'Erros' => $erros,
        'Pontuação' => $partida->placares->sum('pontuacao'),
    ];
@endphp

<section {{ $attributes }} x-data="{ mostrar: true }">
    <div x-show="mostrar">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-[2px] z-40"></div>

        <x-card
            class="w-1/4 min-w-105 fixed top-1/2 left-1/2 z-50 min-h-0 -translate-x-1/2 -translate-y-1/2 bg-white rounded-[28px] shadow-2xl border border-gray-200 px-10 py-8 flex flex-col gap-8">
            <h2 class="font-medium text-2xl text-center flex flex-col leading-tight">
                <span class="font-bold text-3xl mb-4 {{ $perdeu ? 'text-red-600' : 'text-green-600' }}">
                    {{ $perdeu ? 'Derrota' : 'Vitória' }}
                </span>
                <span class="text-gray-600 text-xl font-normal">A palavra era:</span>
                <span class="font-bold text-4xl text-gray-900 mt-2 tracking-tight">
                    {{ $partida->palavra->nome }}
                </span>
            </h2>

            <div class="grid grid-cols-3 gap-3">
                @foreach ($estatisticas as $titulo => $valor)
                    <div class="rounded-2xl border border-gray-200 bg-gray-50 px-4 py-4 text-center shadow-md">
                        <p class="text-sm text-gray-500 font-medium">{{ $titulo }}</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $valor }}</p>
                    </div>
                @endforeach
            </div>

            <div class="flex flex-col gap-4">
                <h2 class="text-2xl font-semibold text-gray-900">Placar</h2>

                <div class="rounded-2xl border p-5 shadow-md border-gray-200  bg-green-50 ">
                    <div class="flex items-start gap-3">

                        <div class="flex flex-col">
                            <span class="text-xs font-semibold uppercase ">
                                {{ $perdeu ? 'Maior pontuação' : 'Vencedor' }}
                            </span>
                            <p class="text-lg text-gray-900">
                                <span class="font-bold text-green-700">
                                    {{ $vencedor->Jogador->nome }}
                                </span>
                                {{ $perdeu ? 'fez a maior pontuação com' : 'ganhou o jogo com' }}
                                <span class="font-bold">{{ $vencedor->pontuacao }} pontos</span>.
                            </p>
                        </div>
                    </div>
                </div>

                @if ($perdedor)
                    <div class="rounded-2xl border border-gray-200 bg-red-50 p-5 shadow-md">
                        <div class="flex items-start gap-3">

                            <div class="flex flex-col">
                                <span class="text-xs font-semibold uppercase text-gray-500">
                                    Segundo jogador
                                </span>
                                <p class="text-lg text-gray-800">
                                    <span class="font-semibold">
                                        {{ $perdedor->Jogador->nome }}
                                    </span>
                                    {{ $perdeu ? 'terminou com' : 'perdeu o jogo com' }}
                                    <span class="font-semibold">{{ $perdedor->pontuacao }} pontos</span>.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <a href="{{ route('dashboard') }}">
                <x-button class="flex justify-center gap-3 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-arrow-left preview-icon">
                        <path d="m12 19-7-7 7-7" />
                        <path d="M19 12H5" />
                    </svg>
                    Voltar
                </x-button>
            </a>
        </x-card>
    </div>
</section>
