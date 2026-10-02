<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script
            defer
            src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
        ></script>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

        <title>Jogo da Forca 2.0</title>
    </head>

    <body>
        <main class="h-screen flex justify-evenly items-center">
            <x-card class="w-[90vw] h-[90vh] bg-white/20">
                <section class="grid grid-cols-2 gap-7 h-screen">
                    <x-dashboard :categorias="$categorias" />
                    <x-relatories
                        :pontuacaoTotal="0"
                        :categorias="$categorias"
                        :palavrasTotal="$palavras->count()"
                    />
                </section>
            </x-card>
        </main>
    </body>
</html>
