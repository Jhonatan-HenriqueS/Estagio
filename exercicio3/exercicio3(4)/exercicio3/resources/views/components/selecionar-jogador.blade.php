<section {{ $attributes }} x-data="{ mostrar: false }">
    <x-button class="flex justify-center" name="modo" value="1" @click="mostrar = !mostrar">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-user preview-icon">
            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
            <circle cx="12" cy="7" r="4" />
        </svg>
        Modo 1 Jogador
    </x-button>

    <div x-show="mostrar">
        <x-fundo-preto />
        <x-card class="w-1/4 fixed top-1/2 left-1/2 z-50 min-h-0 -translate-x-1/2 -translate-y-1/2 bg-white">
            <div class="flex flex-col gap-5">
                <div class="flex justify-between">
                    <p class="text-gray-500 font-light wrap-break-words">
                        Informe seu nome para jogar
                    </p>
                    <x-button-logout />
                </div>
                <label for="jogador_id">Selecione uma categoria</label>
                <input name="jogador_id" placeholder="Informe seu nome: "
                </select>

            </div>
        </x-card>
    </div>
</section>
