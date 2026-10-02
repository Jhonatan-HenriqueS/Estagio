@props(['categorias'])

<x-card>
    <div class="flex gap-10">
        <x-menu-lateral :categorias="$categorias" />
        <div class="flex flex-col gap-3">
            <h1 class="font-bold text-3xl">Dashboard</h1>
            <p class="text-gray-500 font-light">
                Veja um resumo completo da sua jornada até aqui.
            </p>
            <x-modal-partida :categorias="$categorias" class="mt-10 mb-2" />
            <p
                class="text-gray-500 font-light py-5 px-10 bg-white/40 rounded-xl border border-gray-400"
            >
                Nenhum partida jogada ainda.
            </p>
        </div>
    </div>
</x-card>
