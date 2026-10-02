<div {{ $attributes->merge([
    'class' => 'flex flex-col gap-7 border border-white/25 rounded-2xl px-10 py-8 shadow-2xl text-black ' ])
}}>
    {{ $slot }}
</div>