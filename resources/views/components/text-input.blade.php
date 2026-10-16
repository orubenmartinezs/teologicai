@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-white/10 bg-white/[0.06] text-white placeholder-slate-400 focus:border-purple-400 focus:ring-1 focus:ring-purple-400 rounded-xl shadow-inner text-sm']) }}>
