<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <title>Partida</title>
</head>

<body>
    <x-card class="w-1/2 min:h-1/2 fixed top-1/2 left-1/2 z-30 -translate-x-1/2 -translate-y-1/2 gap-30">
        <div class="flex flex-col gap-10">
            <h1 class="text-center font-bold text-3xl">
                {{ $partida->palavra->categoria->nome }}
            </h1>
            <p class="text-xl font-medium flex gap-10 text-center items-center">
                É a vez de: <span class="font-bold text-2xl">{{ $partida->jogadorAtual->nome }}</span>
            </p>
        </div>

       <!-- Utilizei algumas pesquisas para descobrir como desenhar a froca, e cheguei neste resultado -->

        @php
            $qtdErros = count($erros);
            $parteForca = 'stroke-black transition-all duration-300';
        @endphp

        <div class="flex flex-col items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 240" stroke-width="6"
                stroke-linecap="round" class="h-56 w-auto">

                <g class="stroke-amber-950">
                    <path d="M20 230H120" />
                    <path d="M50 230V20" />
                    <path d="M50 20H130" />
                    <path d="M50 55L85 20" />
                    <path d="M130 20V50" />
                </g>

                @if ($qtdErros >= 1)
                    <circle cx="130" cy="70" r="20" class="{{ $parteForca }}" />
                @endif
                @if ($qtdErros >= 2)
                    <path d="M130 90V150" class="{{ $parteForca }}" />
                @endif
                @if ($qtdErros >= 3)
                    <path d="M130 105L105 132" class="{{ $parteForca }}" />
                @endif
                @if ($qtdErros >= 4)
                    <path d="M130 105L155 132" class="{{ $parteForca }}" />
                @endif
                @if ($qtdErros >= 5)
                    <path d="M130 150L108 192" class="{{ $parteForca }}" />
                @endif
                @if ($qtdErros >= 6)
                    <path d="M130 150L152 192" class="{{ $parteForca }}" />
                @endif
            </svg>
        </div>

        <div class="grid gap-8">
            <div class="flex flex-1 relative justify-center gap-3 items-center">
                @foreach (str_split($partida->palavra->nome) as $chave => $letra)
                    <div class="w-1/10 h-2 rounded-full bg-amber-950 flex gap-10 justify-center">
                        @if (isset($acertos[$chave]))
                            <p class="text-4xl font-bold absolute bottom-full uppercase">
                                {{ $acertos[$chave] }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>

            <form action="{{ route('partida.tentou', $partida->id) }}" method="POST">
                @csrf

                <div class="flex flex-wrap gap-1 justify-center">
                    @foreach (range('a', 'z') as $letra)
                        @php
                            $jaUsada = in_array($letra, $acertos) || in_array($letra, $erros);
                        @endphp

                        <button type="submit" name="letra" value="{{ $letra }}" @disabled($jaUsada || $venceu || $perdeu)
                            class="p-4 w-1/12 text-center border border-gray-500 rounded-xl uppercase
                            {{ in_array($letra, $acertos)
                                ? 'bg-green-500 text-white'
                                : (in_array($letra, $erros)
                                    ? 'bg-red-500 text-white'
                                    : 'bg-gray-100 hover:bg-gray-200') }}">
                            {{ $letra }}
                        </button>
                    @endforeach
                </div>
            </form>
            <!-- <form action="{{ route('partida.tentou', $partida->id) }}"method="POST" class="flex flex-col gap-10">
                @csrf

                <div class="flex flex-col gap-2 items-center">
                    <label for="letra" class="font-medium">
                        Digite sua tentativa
                    </label>

                    <input
                        type="text"
                        id="letra"
                        maxlength="1"
                        pattern="[A-Za-z]"
                        name="letra"
                        placeholder="Informe uma letra"
                        class="border p-3 rounded-2xl w-1/2"
                        required
                    />
                </div>

                <x-button
                    type="submit"
                    class="flex justify-center w-1/2! self-center"
                >
                    Tentar
                </x-button>
            </form> -->
        </div>
    </x-card>

    @if ($venceu || $perdeu)
        <x-modal-venceu class="" :partida="$partida" :erros="count($erros)" :acertos="count($acertos)"
            :perdeu="$perdeu" />
    @endif
</body>

</html>
