@props(['categorias'])

<section {{ $attributes }} x-data="{ mostrar: false }">
    <x-button-palavras @click="mostrar = !mostrar" />

    <div x-show="mostrar">
        <x-fundo-preto />
        <x-card class="w-1/4 fixed top-1/2 left-1/2 z-50 min-h-0 -translate-x-1/2 -translate-y-1/2 bg-white">
            <form action="{{ route('palavras.store') }}" method="POST" class="flex flex-col gap-10">
                @csrf
                <div class="flex flex-col gap-5">
                    <div class="flex justify-between">
                        <p class="text-gray-500 font-light wrap-break-words">
                            Crie uma palavra para diversificar seu jogo
                        </p>
                        <x-button-logout />
                    </div>
                    <label for="categoria_id">Selecione uma categoria</label>
                    <select name="categoria_id" id="categoria_id" class="border p-3 rounded-2xl shadow-md " required>
                        <option value="">Selecione...</option>

                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                        @endforeach

                    </select>
                    <label for="nome">Nome da Palavra</label>
                    <input type="text" id="nome" name="nome" placeholder="Informe a palavra"
                        class="border p-3 rounded-2xl shadow-md" required />
                </div>

                <x-button type="submit">Salvar</x-button>
            </form>
        </x-card>
    </div>
</section>
