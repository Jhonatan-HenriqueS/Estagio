<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <title>dashboard</title>
</head>

<body>
    <main class="h-screen flex justify-evenly items-center">
        <x-card class="w-[90vw] h-[90vh] bg-white/20">
            <section class="grid grid-cols-2 gap-7 h-screen">
                <x-dashboard :categorias="$categorias" :partida="$partida" />
                <x-relatories :pontuacaoTotal="0" :categorias="$categorias" :palavrasTotal="$palavras->count()" />
            </section>
        </x-card>
    </main>
    @if ($errors->any() || session('sucesso'))

        <div x-data="{ mostrar: true }" x-init="setTimeout(() => mostrar = false, 5000)" x-show="mostrar"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-3"
            x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-3"
            class="fixed top-5 left-1/2 -translate-x-1/2 z-50
               text-white px-6 py-4 rounded-2xl shadow-xl
               w-[90%] max-w-md
               {{ $errors->any() ? 'bg-red-500' : 'bg-green-500' }}">

            @if ($errors->any())

                @foreach ($errors->all() as $erro)
                    <p>{{ $erro }}</p>
                @endforeach
            @elseif (session('sucesso'))
                <p>{{ session('sucesso') }}</p>

            @endif

        </div>

    @endif
</body>

</html>
