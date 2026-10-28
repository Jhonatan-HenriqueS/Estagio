<section {{ $attributes }} x-data="{ mostrar: false, modo: 1 }">
    <x-button-play @click="mostrar = !mostrar" />

    <div x-show="mostrar">
        <x-fundo-preto />

        <x-card class="w-1/3 fixed top-1/2 left-1/2 z-50 min-h-0 -translate-x-1/2 -translate-y-1/2 bg-white">

            <form action="{{ route('partida.store') }}" method="POST" class="flex flex-col gap-10">
                @csrf

                <div class="flex flex-col gap-3">
                    <div class="flex justify-between">
                        <p class="text-gray-500 font-light wrap-break-words">
                            Seleciona uma categoria para jogar
                        </p>

                        <x-button-logout />
                    </div>

                    <label for="categoria_id">
                        Selecione uma categoria
                    </label>

                    <select name="categoria_id" id="categoria_id" class="border p-3 rounded-2xl shadow-md" required>
                        <option value="">Selecione...</option>

                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">
                                {{ $categoria->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="flex flex-col gap-5">
                    <div class="flex flex-col gap-3">

                    <label for="jogador1_nome">
                        Informe seu nome
                    </label>

                    <input type="text" id="jogador1_nome" placeholder="nome" name="jogador1_nome"
                        class="p-3 border rounded-2xl" required />

                </div>


                <div x-show="modo === 2" class="flex flex-col gap-3">

                    <label for="jogador2_nome">
                        Informe o nome do segundo jogador
                    </label>

                    <input type="text" id="jogador2_nome" placeholder="nome" name="jogador2_nome"
                        class="p-3 border rounded-2xl" :required="modo === 2" />

                </div>
                </div>


                <input type="hidden" name="modo" :value="modo">


                <div class="flex flex-col gap-5">

                    <div class="flex gap-5">
                        <x-button type="button" class="flex justify-center" @click="modo = 1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">

                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />

                            </svg>

                             1 Jogador
                        </x-button>


                        <x-button type="button" class="flex justify-center" @click="modo = 2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-users-round preview-icon">
                                <path d="M18 21a8 8 0 0 0-16 0" />
                                <circle cx="10" cy="8" r="5" />
                                <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                            </svg>
                             2 Jogadores
                        </x-button>

                    </div>

                    <x-button type="submit" class="flex justify-center">
                        Iniciar partida
                    </x-button>

                </div>

            </form>

        </x-card>
    </div>
</section>
