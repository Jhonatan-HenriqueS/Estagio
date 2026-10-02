<section {{ $attributes }} x-data="{ mostrar: false }">
    <x-button-categories @click="mostrar = !mostrar" />

    <div x-show="mostrar">
        <x-fundo-preto />
        <x-card class="w-1/4 fixed top-1/2 left-1/2 z-50 min-h-0 -translate-x-1/2 -translate-y-1/2 bg-white">
            <form action="{{ route('categorias.store') }}" method="POST" class="flex flex-col gap-10">
                @csrf
                <div class="flex flex-col gap-5">
                    <div class="flex justify-between">
                        <p class="text-gray-500 font-light wrap-break-words">
                            Crie uma categoria para diversificar seu jogo
                        </p>
                        <x-button-logout />
                    </div>
                    <label for="nome">Nome da categoria</label>
                    <input type="text" id="nome" name="nome" placeholder="Informe a categoria"
                        class="border p-3 rounded-2xl" required />
                </div>

                <x-button type="submit">Salvar</x-button>
            </form>
        </x-card>
    </div>
</section>
