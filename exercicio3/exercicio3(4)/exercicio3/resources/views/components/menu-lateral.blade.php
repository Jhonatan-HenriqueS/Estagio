@props(['categorias'])

<div x-data="{ mostrar: false }">
    <button @click="mostrar = !mostrar">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="lucide lucide-menu preview-icon"
        >
            <path d="M4 5h16" />
            <path d="M4 12h16" />
            <path d="M4 19h16" />
        </svg>
    </button>
    <x-fundo-preto />
    <div x-show="mostrar">
        <x-card
            class="w-[90%] md:w-1/3 h-screen fixed top-0 left-0 z-50 bg-white/80"
        >
            <div class="inline-flex justify-between">
                <p class="font-semibold text-xl flex gap-3 items-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="lucide lucide-gamepad-2 preview-icon"
                    >
                        <line x1="6" x2="10" y1="11" y2="11" />
                        <line x1="8" x2="8" y1="9" y2="13" />
                        <line x1="15" x2="15.01" y1="12" y2="12" />
                        <line x1="18" x2="18.01" y1="10" y2="10" />
                        <path
                            d="M17.32 5H6.68a4 4 0 0 0-3.978 3.59c-.006.052-.01.101-.017.152C2.604 9.416 2 14.456 2 16a3 3 0 0 0 3 3c1 0 1.5-.5 2-1l1.414-1.414A2 2 0 0 1 9.828 16h4.344a2 2 0 0 1 1.414.586L17 18c.5.5 1 1 2 1a3 3 0 0 0 3-3c0-1.545-.604-6.584-.685-7.258-.007-.05-.011-.1-.017-.151A4 4 0 0 0 17.32 5z"
                        />
                    </svg>
                    Menu de Opções
                </p>
                <x-button-logout />
            </div>
            <x-modal-partida :categorias="$categorias" />
            <x-modal-categorie />
            <x-modal-palavra :categorias="$categorias" />
            <x-button-placar @click="mostrar = false" />
            <x-button @click="mostrar = false">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-gallery-vertical-end preview-icon"
                >
                    <path d="M7 2h10" />
                    <path d="M5 6h14" />
                    <rect width="18" height="12" x="3" y="10" rx="2" />
                </svg>
                Hitórico
            </x-button>
            <x-card class="absolute bottom-8 left-6 right-6">
                <section class="flex justify-between items-center">
                    <div class="flex gap-5 items-center">
                        <p
                            class="bg-blue-500 rounded-xl h-full p-3 w-fit font-semibold"
                        >
                            JH
                        </p>
                        <p>Jhonatan Henrique</p>
                    </div>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="lucide lucide-log-out preview-icon cursor-pointer"
                    >
                        <path d="m16 17 5-5-5-5" />
                        <path d="M21 12H9" />
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    </svg>
                </section>
            </x-card>
        </x-card>
    </div>
</div>
