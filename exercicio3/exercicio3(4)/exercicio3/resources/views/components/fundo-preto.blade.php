<div x-show="mostrar" @click="mostrar = false"
    {{ $attributes->merge([
        'class' => 'fixed inset-0 bg-black/50 z-40',
    ]) }}></div>
