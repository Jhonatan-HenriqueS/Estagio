@props(['acertos', 'erros', 'palavra'])

<section {{ $attributes }} x-data="{ mostrar: true }">
    <div x-show="mostrar">
        <div class="fixed inset-0 bg-black/50 z-40" />
        <x-card
            class="w-1/4 fixed top-1/2 left-1/2 z-50 min-h-0 -translate-x-1/2 -translate-y-1/2 bg-white"
        >
            <h2 class="font-medium text-2xl text-center flex flex-col">
                A palavra era:
                <span class="font-bold text-3xl"> {{ $palavra }} </span>
            </h2>
            <div class="flex flex-col gap-3">
                <p class="">Total de acertos: {{ $acertos }}</p>
                <p class="">Total de erros: {{ $erros }}</p>
                <p class="">Pontuação Total: {{ ($acertos - $erros) * 2 }}</p>
            </div>

            <a href="{{ route('dashboard') }}">
                <x-button class="flex justify-center gap-3">
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
                        class="lucide lucide-arrow-left preview-icon"
                    >
                        <path d="m12 19-7-7 7-7" />
                        <path d="M19 12H5" />
                    </svg>
                    Voltar</x-button
                >
            </a>
        </x-card>
    </div>
</section>
