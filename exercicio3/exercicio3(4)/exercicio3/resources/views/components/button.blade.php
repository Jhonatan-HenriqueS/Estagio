<button {{ $attributes->merge([
    'class' => ' h-fit w-full py-4 px-10 rounded-xl flex gap-3 bg-green-400 text-white shadow-md shadow-green-600 font-medium transform transition-all duration-200 ease-in-out hover:scale-103 hover:bg-green-500 hover:shadow-xl'    
]) }}>
    {{ $slot }}
</button>