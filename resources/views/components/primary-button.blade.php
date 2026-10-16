<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gradient-to-tr from-purple-600 to-fuchsia-500 hover:from-purple-500 hover:to-fuchsia-400 border border-purple-400/30 rounded-xl font-semibold text-xs text-white uppercase tracking-wider shadow-md shadow-purple-600/30 focus:outline-none focus:ring-2 focus:ring-purple-400 active:scale-95 transition-all cursor-pointer']) }}>
    {{ $slot }}
</button>
