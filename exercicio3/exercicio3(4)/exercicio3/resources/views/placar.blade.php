<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Placar</title>
</head>

<body class=" flex justify-center">
    <x-card class="w-1/2 h-[90vh] m-10">
        <form action="{{ route('placar') }}" method="GET" class="w-full flex justify-between items-center">
            <label for="ordenar" class="font-bold text-2xl flex gap-5 items-center">
                <a href="{{ route('dashboard') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left preview-icon">
                        <path d="m12 19-7-7 7-7" />
                        <path d="M19 12H5" />
                    </svg>
                </a> Placar dos jogadores </label>
            <select name="ordenar" onchange="this.form.submit()" class="bg-gray-300 p-3 rounded-2xl">
                <option value="" @selected(!request('ordenar'))>Filtrar...</option>
                <option value="pontuacao" @selected(request('ordenar') === 'pontuacao')>Pontuação</option>
                <option value="nome" @selected(request('ordenar') === 'nome')>Nome</option>
                <option value="partidas" @selected(request('ordenar') === 'partidas')>Partida</option>
            </select>
        </form>
        <table class="flex flex-col justify-center gap-7 w-full table-fixed">
            <thead class="bg-gray-300 px-10 py-6 rounded-2xl">
                <tr class="flex justify-between">
                    <th class="">NOME</th>
                    <th class="">PONTUAÇÃO</th>
                    <th class="">PARTIDAS</th>
                </tr>
            </thead>
            <tbody class="flex flex-col gap-5">
                @foreach ($jogadores as $jogador)
                    <tr
                        class="grid grid-cols-3 items-center py-3 px-10
                        {{ $loop->even ? 'bg-gray-400 hover:bg-gray-500' : 'bg-gray-200 hover:bg-gray-300' }}
                        rounded-2xl transform transition-all duration-200 ease-in-out
                        hover:scale-103 hover:shadow-xl">

                        <td class="flex items-center gap-8 min-w-0">
                            <span class="font-bold text-xl w-8 shrink-0">
                                {{ $loop->iteration }}°
                            </span>

                            <span class="truncate">
                                {{ $jogador->nome }}
                            </span>
                        </td>

                        <td class="text-center">
                            {{ $jogador->placares_sum_pontuacao ?? 0 }}
                        </td>

                        <td class="text-center ml-54">
                            {{ $jogador->placares_count }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-card>
</body>

</html>
