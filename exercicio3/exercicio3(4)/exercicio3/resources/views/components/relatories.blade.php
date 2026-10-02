@props([ 'pontuacaoTotal', 'categorias', 'palavrasTotal'])

<section class="grid grid-flow-col grid-rows-3 gap-5">
    <x-relatorie-text
        :valor="$pontuacaoTotal"
        tipo="Pontuação"
        descricao="Visualize os jogadores"
    >
        <x-slot:botao> <x-button-placar /></x-slot:botao>
    </x-relatorie-text>
    <x-relatorie-text
        :valor="$categorias->count()"
        tipo="Categorias"
        descricao="Crie sua categoria"
    >
        <x-slot:botao> <x-modal-categorie /> </x-slot:botao
    ></x-relatorie-text>
    <x-relatorie-text
        :valor="$palavrasTotal"
        tipo="Palavras"
        descricao="Crie sua palavra"
    >
        <x-slot:botao>
            <x-modal-palavra :categorias="$categorias" /></x-slot:botao
    ></x-relatorie-text>
</section>
