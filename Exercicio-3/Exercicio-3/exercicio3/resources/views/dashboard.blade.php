<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <title>Jogo da Forca 2.0</title>
</head>
<body>
    <section class="h-screen flex bg-blue-50">
        <div class="w-[90vw] h-[90vh] grid gap-10 bg-white/40 backdrop-blur-md border border-white/25 rounded-2xl px-10 py-8 shadow-xl text-black max-w-sm w-">
            <h1 class="font-bold text-3xl">Dashboard</h1>

           <div>
                {{-- @foreach($palavras as $palavra)
                    <p>{{ $palavra->nome }}</p>
                @endforeach --}}

                {{ $categorias->count() }}

           </div>
        </div>
    </section>
</body>
</html>
