<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Histórico</title>
</head>

<body class="flex justify-center">
    <x-card class="w-1/2 h-[90vh] m-10">
        <div class="w-full flex justify-between items-center">
            <p class="font-bold text-2xl flex gap-5 items-center">
                <a href="{{ route('dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-arrow-left preview-icon">
                        <path d="m12 19-7-7 7-7" />
                        <path d="M19 12H5" />
                    </svg>
                </a>
                Histórico de partidas
            </p>
            <span class="bg-gray-300 px-5 py-3 rounded-2xl font-medium">
                {{ $partidas->count() }} {{ $partidas->count() === 1 ? 'partida' : 'partidas' }}
            </span>
        </div>

        <div class="flex flex-col gap-5 flex-1 min-h-0 overflow-y-auto pr-2">
            @foreach ($partidas as $partida)
                <div
                    class="flex flex-col gap-5 py-5 px-10 bg-gray-200 rounded-2xl">

                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-5 min-w-0">
                            <span class="font-bold text-xl shrink-0">#{{ $partida->id }}</span>
                            <span class="truncate font-medium uppercase tracking-wider text-2xl">
                                {{ $partida->palavra->nome }}
                            </span>
                        </div>

                        <span
                            class="px-4 py-1 rounded-xl text-sm font-medium text-white shrink-0
                            {{ $partida->finalizada ? 'bg-green-500' : 'bg-red-500' }}">
                            {{ $partida->finalizada ? 'Finalizada' : 'Não finalizada' }}
                        </span>
                    </div>

                    <div class="flex flex-wrap gap-3 items-center text-sm">
                        <span class="bg-white/60 px-4 py-2 rounded-xl font-medium">
                            {{ $partida->palavra->categoria->nome }}
                        </span>
                        <span class="bg-green-100 text-green-700 px-4 py-2 rounded-xl font-medium">
                            Acertos: {{ $partida->total_acertos }}
                        </span>
                        <span class="bg-red-100 text-red-700 px-4 py-2 rounded-xl font-medium">
                            Erros: {{ $partida->total_erros }}
                        </span>
                        <span class="text-gray-600 font-light ml-auto flex flex-col gap-3">
                            <p> Duração: {{ $partida->duracao ?? '—' }}</p>
                            <p>{{ $partida->created_at->format('d/m/Y') }}</p>
                        </span>
                    </div>

                    <div class="flex flex-col gap-2 border-t border-gray-500/40 pt-4">
                        @foreach ($partida->placares as $placar)
                            <div class="flex justify-between items-center">
                                <span class="flex items-center gap-3 min-w-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                    <span class="truncate {{ $partida->vencedor_id === $placar->id ? 'font-bold text-green-700' : '' }}">
                                        {{ $placar->jogador->nome }}
                                        @if ($partida->vencedor_id === $placar->id)
                                             vencedor
                                        @endif
                                    </span>
                                </span>
                                <span class="font-bold">{{ $placar->pontuacao }} pts</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            @if ($partidas->isEmpty())
                <p class="text-gray-500 font-light text-center py-10 bg-white/40 rounded-xl border border-gray-400">
                    Nenhuma partida jogada até o momento.
                </p>
            @endif
            </div>
    </x-card>
</body>

</html>
