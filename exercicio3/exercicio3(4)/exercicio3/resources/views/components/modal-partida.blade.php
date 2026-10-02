<section {{ $attributes }} x-data="{ mostrar: false }">
    <x-button-play @click="mostrar = !mostrar" />

    <div x-show="mostrar">
        <x-fundo-preto />
        <x-card class="w-1/4 fixed top-1/2 left-1/2 z-50 min-h-0 -translate-x-1/2 -translate-y-1/2 bg-white">
            <form action="{{ route('partida.store') }}" method="POST" class="flex flex-col gap-10">
                @csrf
                <div class="flex flex-col gap-5">
                    <div class="flex justify-between">
                        <p class="text-gray-500 font-light wrap-break-words">
                            Seleciona uma categoria para jogar
                        </p>
                        <x-button-logout />
                    </div>
                    <label for="categoria_id">Selecione uma categoria</label>
                    <select name="categoria_id" id="categoria_id" class="border p-3 rounded-2xl shadow-md" required>
                        <option value="">Selecione...</option>

                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                        @endforeach

                    </select>

                </div>

                <div class="flex flex-col gap-5">
                    <x-button class="flex justify-center" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-user preview-icon">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        Modo 1 Jogador
                    </x-button>

                    <x-button class="flex justify-center" type="submit" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-users preview-icon">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <path d="M16 3.128a4 4 0 0 1 0 7.744" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <circle cx="9" cy="7" r="4" />
                        </svg>
                        Modo 2 Jogadores
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>
</section>
