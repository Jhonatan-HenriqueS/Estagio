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
        <h1 class="text-center font-bold text-3xl">
            {{ $partida->palavra->categoria->nome }}
        </h1>

        <div class="grid gap-8">
            <div class="flex flex-1 relative justify-center gap-3 items-center">
                @foreach (str_split($partida->palavra->categoria->nome) as $chave => $letra)
                    <div class="w-1/10 h-2 rounded-full bg-amber-950 flex gap-10 justify-center">
                        @if (isset($acertos[$chave]))
                            <p class="text-4xl font-bold absolute bottom-full uppercase">
                                {{ $acertos[$chave] }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="flex flex-wrap gap-1 justify-center">
                @foreach (range('a', 'z') as $letra)
                    <p
                        class="p-4 w-1/12 text-center border border-gray-500 rounded-xl bg-gray-100">
                        {{  $letra }}
                    </p>
                @endforeach
            </div>

            <form action="{{ route('partida.tentou', $partida->id) }}" method="POST" class="flex flex-col gap-10">
                @csrf
                <div class="flex flex-col gap-2 items-center">
                    <label for="letra" class="font-medium">Digite sua tentativa</label>
                    <input type="text" id="letra" maxlength="1" pattern="[A-Za-z]" name="letra"
                        placeholder="Informe uma letra" class="border p-3 rounded-2xl w-1/2" required />
                </div>

                <x-button type="submit" class="flex flex-col justify-center">Tentar</x-button>
            </form>
        </div>
    </x-card>

    {{-- @if ($venceu)
        <x-modal-venceu
            class=""
            :acertos="count($acertos)"
            :erros="count($erros)"
            :palavra="$partida->palavra->nome" />
    @endif --}}
</body>

</html>
