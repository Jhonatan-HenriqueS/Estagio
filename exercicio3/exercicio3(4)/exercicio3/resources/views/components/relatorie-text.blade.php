@props(['valor', 'tipo', 'descricao'])

<x-card class="h-full">
    <div class="flex h-full w-full justify-between">
        <div class="flex flex-col justify-between">
            <p class="text-2xl font-medium tracking-wider">TOTAL</p>

            <p class="text-5xl font-medium leading-none">
                {{ $valor }}
            </p>

            <p class="text-xl font-medium">
                {{ $tipo }}
            </p>
        </div>

        <div class="self-center w-1/2">
            {{ $botao }}
            <p class="text-gray-500 font-light text-end mt-5">
                {{ $descricao }}
            </p>
        </div>
    </div>
</x-card>
