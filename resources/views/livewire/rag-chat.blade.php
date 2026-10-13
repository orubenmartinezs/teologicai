{{--
 * Author: Oscar Ruben Martinez Sanchez
 * (c) 2026 - Personal Project
 * Identity: @signature orms-kermint-2000
--}}
{{--
    Frente Alpha: TheoLogic AI (Tema Oscuro Glassmorphism / Púrpura)
    Interfaz de usuario premium para consultas de teologia e inteligencia artificial avanzada.
--}}
@php
    $bgGradient = 'bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-[#837088] via-[#4d3e5b] to-[#312a38]';
    $sidebarBg = 'bg-[#4a4154]/40 backdrop-blur-xl';
    $sidebarBorder = 'border-white/10';
    $textColor = 'text-white/90';
    $mutedText = 'text-white/60';
    $aiBubbleBg = 'bg-[#3c314a] shadow-sm border border-white/5';
    $aiText = 'text-[#f4f0f8] text-[15px]';
    $userBubbleBg = 'bg-[#f8eedf] shadow-sm';
    $userText = 'text-[#332b3f]';
    $accent = 'text-white/80';
    $title = 'TheoLogic AI';
    $inputBg = 'bg-[#f8eedf] shadow-xl';
    $inputText = 'text-[#332b3f]';
@endphp

<div x-data="{
    sidebarOpen: false,
    settingsOpen: false,
    settingsTab: 'perfil',
    showSources: false,
    activeSources: [],
    showProfileMenu: false,
    intraSearch: '',
    openSettings(tab = 'perfil') {
        this.settingsTab = tab;
        this.settingsOpen = true;
        this.showProfileMenu = false;
    },
    findInChat() {
        if (this.intraSearch === '') return;
        window.find(this.intraSearch);
    },
    copyText(text) {
        navigator.clipboard.writeText(text);
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '¡Respuesta copiada!',
            showConfirmButton: false,
            timer: 2000,
            background: '#1e192c',
            color: '#e2dde9',
            iconColor: '#9d7cf5'
        });
    }
}"
    class="flex h-screen bg-[#312a38] {{ $textColor }} font-sans overflow-hidden">

    <!-- Overlay Móvil -->
    <div x-show="sidebarOpen" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 md:hidden"
        @click="sidebarOpen = false" x-transition.opacity></div>

    <!-- Sidebar / Bottom Sheet -->
    <aside
        class="
            flex flex-col justify-between z-50 flex-shrink-0 transition-transform duration-300
            fixed inset-x-0 bottom-0 h-[85vh] bg-[#3a3145]/95 backdrop-blur-2xl rounded-t-[32px] p-6 shadow-[0_-10px_40px_rgba(0,0,0,0.5)]
            md:relative md:w-[350px] md:h-auto md:bg-transparent md:backdrop-blur-none md:p-4 md:rounded-none md:shadow-none md:translate-y-0 md:flex
        "
        :class="sidebarOpen ? 'translate-y-0' : 'translate-y-full md:translate-y-0'">
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Logo -->
            <div class="flex items-center gap-3 px-2 mb-8 mt-2">
                <div
                    class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center text-white shadow-sm border border-white/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                </div>
                <span
                    class="font-bold text-[17px] tracking-wide">TheoLogic AI</span>
                <button class="md:hidden ml-auto text-white/50 hover:text-white" @click="sidebarOpen = false">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- New Chat Button -->
            <button wire:click="startNewChat"
                class="w-full flex items-center justify-center bg-[#f8eedf] hover:bg-white text-[#332b3f] rounded-full py-2.5 px-4 mb-4 shadow-sm transition-colors group"
                wire:loading.attr="disabled">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="text-[13px] font-semibold">Nuevo Chat</span>
                </div>
            </button>

            <!-- Search Chats -->
            <div class="relative px-2 mb-6">
                <svg class="w-4 h-4 absolute left-4 top-2 text-white/40" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" wire:model.live="searchChat" placeholder="Buscar chat..."
                    class="w-full bg-white/5 border border-white/10 text-white text-xs rounded-lg pl-9 pr-3 py-2 focus:ring-1 focus:ring-white/50 focus:outline-none placeholder-white/30 transition-all">
            </div>

            <!-- Chat History -->
            <div class="px-2 flex-1 overflow-y-auto custom-scrollbar">

                @php
                    $pinnedChats = collect($this->chats ?? [])->where('is_pinned', true);
                    $recentChats = collect($this->chats ?? [])->where('is_pinned', false);
                @endphp

                @if ($pinnedChats->count() > 0)
                    <!-- Favoritos -->
                    <div class="mb-6">
                        <p class="text-[10px] font-bold text-white/40 uppercase tracking-wider mb-2 px-2">Favoritos</p>
                        <div class="space-y-0.5">
                            @foreach ($pinnedChats as $chat)
                                <div class="relative group flex items-center w-full">
                                    <button wire:click="selectChat({{ $chat->id }})"
                                        class="w-full flex items-center gap-3 px-2 py-2 rounded-lg {{ ($activeChatId ?? null) === $chat->id ? 'bg-white/10 text-white' : 'hover:bg-white/5 text-white/70 hover:text-white' }} transition-colors text-left pr-16">
                                        <svg class="w-4 h-4 text-[#f8eedf] shrink-0" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                        </svg>
                                        <span
                                            class="text-[13px] {{ ($activeChatId ?? null) === $chat->id ? 'font-semibold' : 'font-medium' }} truncate flex-1">{{ $chat->title }}</span>
                                    </button>

                                    <!-- Hover Actions -->
                                    <div
                                        class="absolute right-2 opacity-0 group-hover:opacity-100 flex items-center gap-1 transition-opacity bg-[#181523] pl-2 rounded-lg py-1 shadow-[-10px_0_10px_#181523]">
                                        <button wire:click.stop="togglePinChat({{ $chat->id }})"
                                            class="p-1.5 rounded-md hover:bg-white/10 text-[#f8eedf] transition-colors"
                                            title="Quitar de favoritos">
                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                            </svg>
                                        </button>
                                        <button wire:click.stop="deleteChat({{ $chat->id }})"
                                            class="p-1.5 rounded-md hover:bg-red-500/20 text-red-400 transition-colors"
                                            title="Eliminar chat">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Recientes -->
                <div>
                    <p class="text-[10px] font-bold text-white/40 uppercase tracking-wider mb-2 px-2">Recientes</p>
                    <div class="space-y-0.5">
                        @foreach ($recentChats as $chat)
                            <div class="relative group flex items-center w-full">
                                <button wire:click="selectChat({{ $chat->id }})"
                                    class="w-full flex items-center gap-3 px-2 py-2 rounded-lg {{ ($activeChatId ?? null) === $chat->id ? 'bg-white/10 text-white' : 'hover:bg-white/5 text-white/70 hover:text-white' }} transition-colors text-left pr-16">
                                    <svg class="w-4 h-4 opacity-50 shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                        </path>
                                    </svg>
                                    <span
                                        class="text-[13px] {{ ($activeChatId ?? null) === $chat->id ? 'font-semibold' : 'font-medium' }} truncate flex-1">{{ $chat->title }}</span>
                                </button>

                                <!-- Hover Actions -->
                                <div
                                    class="absolute right-2 opacity-0 group-hover:opacity-100 flex items-center gap-1 transition-opacity bg-[#181523] pl-2 rounded-lg py-1 shadow-[-10px_0_10px_#181523]">
                                    <button wire:click.stop="togglePinChat({{ $chat->id }})"
                                        class="p-1.5 rounded-md hover:bg-white/10 text-white/50 hover:text-white transition-colors"
                                        title="Añadir a favoritos">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                        </svg>
                                    </button>
                                    <button wire:click.stop="deleteChat({{ $chat->id }})"
                                        class="p-1.5 rounded-md hover:bg-red-500/20 text-white/50 hover:text-red-400 transition-colors"
                                        title="Eliminar chat">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                        @if ($recentChats->count() === 0 && $pinnedChats->count() === 0)
                            <p class="text-xs text-white/40 px-2 italic">No hay conversaciones aún.</p>
                        @endif
                    </div>
                </div>
            </div>

            @if (auth()->check())
                <div class="mt-4 px-2">
                    <div
                        class="bg-white/5 border border-white/10 rounded-2xl p-4 shadow-sm text-sm relative overflow-hidden group hover:border-white/30 transition-colors">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                        </div>
                        <div class="w-8 h-8 rounded-full bg-black/40 flex items-center justify-center mb-3">
                            <svg class="w-4 h-4 text-[#f8eedf]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                </path>
                            </svg>
                        </div>
                        <div class="font-bold text-white mb-1">Mejorar a Premium</div>
                        <p class="text-xs text-white/60 mb-4">Impulsa tu productividad con IA avanzada y capacidades
                            ilimitadas.</p>
                        <button
                            class="w-full py-2 bg-white/5 border border-white/10 hover:bg-white/10 rounded-xl text-xs font-semibold text-white transition-colors"
                            onclick="Swal.fire({title: 'Promoción Exclusiva', text: 'Esta es una funcionalidad de demostración de Alpha.', icon: 'info', confirmButtonColor: '#4a4154', confirmButtonText: 'Entendido', background: '#1e192c', color: '#e2dde9'})">
                            Mejorar Plan
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </aside>

    <!-- Chat Area -->
    <div
        class="flex-1 flex flex-col justify-between relative w-full overflow-hidden {{ $bgGradient }} z-10 rounded-none md:rounded-l-[40px] shadow-none md:shadow-[-10px_0_30px_rgba(0,0,0,0.3)] border-none md:border-solid md:border-l md:border-y md:border-white/5">

        <!-- Header -->
        <header class="h-16 px-6 md:px-8 flex items-center justify-between z-10 pt-6">
            <div class="flex-1 flex items-center gap-3">
                <button class="md:hidden text-white/80 hover:text-white" @click="sidebarOpen = true">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Buscador Centrado -->
            <div class="flex-1 flex justify-center max-w-lg w-full px-4">
                <div class="relative w-full" x-data>
                    <input type="text" x-model="intraSearch" @keyup.enter="findInChat()"
                        placeholder="Buscar en chat..."
                        class="w-full bg-white/10 backdrop-blur-md border border-white/20 rounded-full py-2 pl-10 pr-4 text-xs focus:ring-1 focus:ring-white/50 focus:outline-none text-white transition-all placeholder-white/50">
                    <svg class="w-4 h-4 text-white/50 absolute left-3.5 top-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="flex-1 flex items-center justify-end gap-2">
                <div class="relative ml-2">
                    <button @click="showProfileMenu = !showProfileMenu"
                        class="flex items-center hover:bg-white/5 rounded-full p-0.5 transition-colors">
                        @if (auth()->check())
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=181523&color=fff"
                                class="w-8 h-8 rounded-full border border-white/10 shadow-sm">
                        @else
                            <div
                                class="w-8 h-8 rounded-full border border-white/10 shadow-sm bg-white/10 flex items-center justify-center text-white text-xs">
                                GA</div>
                        @endif
                    </button>

                    <div x-show="showProfileMenu" @click.away="showProfileMenu = false"
                        class="absolute right-0 mt-2 w-56 bg-[#1e1a2d] border-white/10 text-white border shadow-2xl rounded-xl py-3 z-50 overflow-hidden"
                        style="display: none;">
                        @if (auth()->check())
                            <div class="flex flex-col items-center pb-2 px-4 mt-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=181523&color=fff&size=64"
                                    class="w-16 h-16 rounded-full border border-white/10 shadow-sm mb-3">
                                <span
                                    class="font-medium text-[14px] text-white/90 text-center">{{ auth()->user()->name }}</span>
                                <span
                                    class="text-[11px] text-[#8a859c] text-center truncate w-full">{{ auth()->user()->email }}</span>
                            </div>
                            <div class="w-full h-px bg-white/10 my-2"></div>
                        @endif
                        <button @click="openSettings('perfil')"
                            class="w-full text-left block px-4 py-2.5 text-[13px] hover:bg-white/5 flex items-center gap-2">
                            <svg class="w-4 h-4 text-white/50" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Configuración
                        </button>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2.5 text-[13px] text-red-400 hover:bg-white/5 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto px-4 md:px-32 py-10 space-y-6" id="chat-container" x-data
            x-init="$watch('$wire.messages', () => { setTimeout(() => $el.scrollTo({ top: $el.scrollHeight, behavior: 'smooth' }), 50) })">
            @if (count($messages) === 1)
                <!-- Welcome Screen -->
                <div class="mt-4 md:mt-16 max-w-4xl mx-auto w-full flex flex-col items-center">
                    <div
                        class="relative w-24 h-24 rounded-3xl bg-white/10 shadow-2xl mb-10 flex items-center justify-center border border-white/20 backdrop-blur-md">
                        <svg class="w-12 h-12 text-white relative z-10" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-3xl md:text-[34px] font-medium text-center mb-10 tracking-tight text-white/95">
                        ¿Listo para crear algo nuevo?</h2>

                    <div class="flex items-center justify-center gap-4 w-full max-w-2xl mb-12">
                    </div>
                </div>
            @endif

            <div class="max-w-4xl mx-auto space-y-8">
                @foreach ($messages as $index => $message)
                    @if ($index !== 0)
                        @if ($message['role'] === 'user')
                            <div class="flex justify-end">
                                <div
                                    class="{{ $userBubbleBg }} {{ $userText }} px-6 py-4 rounded-3xl max-w-2xl text-[15px] font-medium leading-relaxed">
                                    {{ $message['content'] }}
                                </div>
                            </div>
                        @else
                            <div class="flex justify-start">
                                <div
                                    class="{{ $aiBubbleBg }} {{ $aiText }} px-6 py-4 rounded-3xl max-w-3xl leading-relaxed tracking-wide font-light">
                                    <div
                                        class="w-8 h-8 rounded-xl bg-white/10 backdrop-blur-md shadow-sm mb-4 flex items-center justify-center text-white border border-white/20">
                                        <svg class="w-4 h-4 text-[#f8eedf]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                            </path>
                                        </svg>
                                    </div>

                                    <div
                                        class="prose prose-invert prose-sm md:prose-base text-[#e2dde9] max-w-none font-medium">
                                        {!! Str::markdown($message['content']) !!}</div>

                                    <!-- Actions & Sources -->
                                    <div class="mt-6 flex flex-wrap items-center gap-3">
                                        <button @click="copyText(`{{ addslashes($message['content']) }}`)"
                                            class="p-2 rounded-lg bg-white/5 hover:bg-white/10 text-slate-400 transition-colors"
                                            title="Copiar">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </button>
                                        <!-- Artifact: Exportar a Markdown -->
                                        <button wire:click="exportToMarkdown({{ $index }})"
                                            class="p-2 rounded-lg bg-white/5 hover:bg-white/10 text-slate-400 transition-colors flex items-center gap-2 text-xs font-semibold"
                                            title="Exportar a Markdown">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                </path>
                                            </svg>
                                            Markdown
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>

            <div id="bottom-spacer" class="h-10"></div>
        </main>

        <!-- Input Area -->
        <div class="px-4 md:px-32 pb-4 md:pb-8 pt-4 w-full relative z-20">
            <div class="max-w-4xl mx-auto relative" x-data="{
                statuses: ['Analizando consulta...', 'Buscando en la base de conocimientos...', 'Confeccionando respuesta...'],
                currentStatus: 0,
                statusInterval: null,
                startStatus() {
                    this.currentStatus = 0;
                    this.statusInterval = setInterval(() => {
                        this.currentStatus = (this.currentStatus + 1) % this.statuses.length;
                    }, 2000);
                },
                stopStatus() {
                    clearInterval(this.statusInterval);
                }
            }"
                x-on:livewire:message-sent.window="startStatus()"
                x-on:livewire:message-processed.window="stopStatus()">

                <!-- Status Overlay (Thinking...) -->
                <div wire:loading wire:target="sendMessage"
                    class="absolute -top-8 left-0 text-xs font-medium text-white/70 flex items-center gap-2 animate-pulse">
                    <span x-text="statuses[currentStatus]">Pensando...</span>
                </div>

                <form wire:submit.prevent="sendMessage" class="relative group">
                    <div
                        class="{{ $inputBg }} flex shadow-2xl overflow-hidden transition-all duration-300 ring-1 ring-black/5 focus-within:ring-white/50 items-end p-2 relative rounded-[28px]">

                        <!-- Pulse animation overlay during loading -->
                        <div wire:loading wire:target="sendMessage"
                            class="absolute inset-0 bg-[#9d7cf5]/10 animate-pulse pointer-events-none rounded-[24px]">
                        </div>

                        <textarea wire:model="prompt" rows="1" x-data="{
                            resize() {
                                $el.style.height = '48px';
                                $el.style.height = Math.min($el.scrollHeight, 200) + 'px';
                            }
                        }" x-init="resize()" @input="resize()"
                            @keydown.enter.prevent="if(!$event.shiftKey) { $el.closest('form').dispatchEvent(new Event('submit', { bubbles: true, cancelable: true })); $el.style.height='48px'; }"
                            placeholder="Pregunta cualquier cosa..." wire:loading.attr="disabled" wire:target="sendMessage"
                            class="w-full bg-transparent resize-none focus:outline-none focus:ring-0 {{ $inputText }} px-4 py-3 text-[15px] min-h-[48px] max-h-[200px] border-none placeholder-[#332b3f]/50 font-medium disabled:opacity-50"></textarea>

                        <div class="flex items-center gap-2 shrink-0">
                            <button type="submit"
                                class="p-2.5 rounded-full bg-[#3a3145] hover:bg-[#2e2637] text-white shadow-lg transition-transform hover:scale-105 active:scale-95 disabled:opacity-50 disabled:hover:scale-100 disabled:cursor-not-allowed"
                                wire:loading.attr="disabled" wire:target="sendMessage">
                                <svg wire:loading.remove wire:target="sendMessage" class="w-4 h-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                </svg>
                                <svg wire:loading wire:target="sendMessage" class="w-4 h-4 animate-spin text-white"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Footer Pills (Only on empty chat) -->
                @if (count($messages ?? []) === 1 && !empty($promptStarters))
                    <div class="mt-4 flex flex-wrap justify-center gap-2 max-w-3xl mx-auto">
                        @foreach($promptStarters as $starter)
                        <button
                            wire:click="setPromptAndSend('{{ addslashes($starter) }}')"
                            class="px-4 py-1.5 rounded-full bg-[#f8eedf]/80 backdrop-blur border border-[#332b3f]/10 hover:bg-[#f8eedf] transition-all flex items-center gap-2 text-xs text-[#332b3f]">
                            <div class="w-4 h-4 flex items-center justify-center opacity-70">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                    </path>
                                </svg>
                            </div>
                            {{ \Illuminate\Support\Str::limit($starter, 30) }}
                        </button>
                        @endforeach
                    </div>
                @endif

                <p class="text-center text-[11px] text-white/40 mt-4 font-medium tracking-wide">
                    La IA puede cometer errores. Considera verificar la información importante.
                </p>

            </div>
        </div>
    </div>

    {{-- =====================================================================
         Modal de Configuración (Estilo ChatGPT/DeepSeek)
         Controlado por Alpine.js: settingsOpen, settingsTab
         Contiene cuatro pestañas:
           - perfil      → Formularios Livewire de perfil y contraseña
           - premium     → CTA de mejora de plan
           - terminos    → Términos de uso (placeholder)
           - privacidad  → Política de privacidad (placeholder)
    ====================================================================== --}}
    <div x-show="settingsOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-black/70 backdrop-blur-sm p-4"
        @keydown.escape.window="settingsOpen = false" style="display: none;">
        {{-- Panel principal del Modal --}}
        <div class="relative bg-[#2d2640] border border-white/10 rounded-2xl shadow-2xl w-full max-w-3xl max-h-[85vh] flex overflow-hidden"
            @click.stop x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95">

            {{-- ─── Barra lateral izquierda (navegación de pestañas) ─── --}}
            <nav class="w-56 flex-shrink-0 bg-[#231d33] border-r border-white/10 flex flex-col py-4 overflow-y-auto">

                {{-- Título --}}
                <div class="px-5 mb-5">
                    <h2 class="text-[15px] font-semibold text-white/90 tracking-wide">Configuración</h2>
                </div>

                {{-- Separador --}}
                <div class="h-px bg-white/10 mx-4 mb-3"></div>

                {{-- Enlace: Perfil --}}
                <button @click="settingsTab = 'perfil'"
                    :class="settingsTab === 'perfil' ? 'bg-white/10 text-white' :
                        'text-white/60 hover:bg-white/5 hover:text-white'"
                    class="w-full text-left flex items-center gap-3 px-5 py-2.5 text-sm font-medium transition-colors rounded-lg mx-2 mb-1"
                    style="width: calc(100% - 16px);">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Perfil
                </button>

                {{-- Enlace: Plan Premium --}}
                <button @click="settingsTab = 'premium'"
                    :class="settingsTab === 'premium' ? 'bg-white/10 text-white' :
                        'text-white/60 hover:bg-white/5 hover:text-white'"
                    class="w-full text-left flex items-center gap-3 px-5 py-2.5 text-sm font-medium transition-colors rounded-lg mx-2 mb-1"
                    style="width: calc(100% - 16px);">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    Plan Premium
                </button>

                {{-- Separador --}}
                <div class="h-px bg-white/10 mx-4 my-3"></div>

                {{-- Enlace: Términos de Uso --}}
                <button @click="settingsTab = 'terminos'"
                    :class="settingsTab === 'terminos' ? 'bg-white/10 text-white' :
                        'text-white/60 hover:bg-white/5 hover:text-white'"
                    class="w-full text-left flex items-center gap-3 px-5 py-2.5 text-sm font-medium transition-colors rounded-lg mx-2 mb-1"
                    style="width: calc(100% - 16px);">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Términos de Uso
                </button>

                {{-- Enlace: Privacidad --}}
                <button @click="settingsTab = 'privacidad'"
                    :class="settingsTab === 'privacidad' ? 'bg-white/10 text-white' :
                        'text-white/60 hover:bg-white/5 hover:text-white'"
                    class="w-full text-left flex items-center gap-3 px-5 py-2.5 text-sm font-medium transition-colors rounded-lg mx-2"
                    style="width: calc(100% - 16px);">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    Política de Privacidad
                </button>
            </nav>

            {{-- ─── Área de contenido (derecha) ─── --}}
            <div class="flex-1 overflow-y-auto">

                {{-- Botón cerrar --}}
                <button @click="settingsOpen = false"
                    class="absolute top-4 right-4 text-white/40 hover:text-white/80 transition-colors z-10 w-8 h-8 flex items-center justify-center rounded-lg hover:bg-white/10"
                    title="Cerrar">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                {{-- ── Tab: Perfil ── --}}
                <div x-show="settingsTab === 'perfil'" class="p-8 space-y-8">

                    <div>
                        <h3 class="text-white text-base font-semibold mb-1">Información de Perfil</h3>
                        <p class="text-white/50 text-[13px]">Actualiza tu nombre y dirección de correo electrónico.</p>
                    </div>
                    <div class="h-px bg-white/10"></div>

                    {{-- Formulario: Información del perfil (Livewire) --}}
                    <livewire:profile.update-profile-information-form />

                    <div class="h-px bg-white/10"></div>

                    <div>
                        <h3 class="text-white text-base font-semibold mb-1">Cambiar Contraseña</h3>
                        <p class="text-white/50 text-[13px]">Asegúrate de usar una contraseña larga y aleatoria.</p>
                    </div>
                    <div class="h-px bg-white/10"></div>

                    {{-- Formulario: Cambio de contraseña (Livewire) --}}
                    <livewire:profile.update-password-form />

                    <div class="h-px bg-white/10"></div>

                    {{-- Formulario: Eliminar cuenta (Livewire) --}}
                    <livewire:profile.delete-user-form />

                </div>

                {{-- ── Tab: Premium ── --}}
                <div x-show="settingsTab === 'premium'" class="p-8">
                    <div class="mb-6">
                        <h3 class="text-white text-base font-semibold mb-1">Plan Premium</h3>
                        <p class="text-white/50 text-[13px]">Impulsa tu productividad con IA avanzada y capacidades
                            ilimitadas.</p>
                    </div>
                    <div class="h-px bg-white/10 mb-6"></div>

                    {{-- CTA Card --}}
                    <div
                        class="relative rounded-2xl bg-gradient-to-br from-[#7c5cbf]/40 to-[#3a3145]/60 border border-[#9d7cf5]/30 p-6 overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-[#9d7cf5]/10 to-transparent pointer-events-none rounded-2xl">
                        </div>
                        <div class="relative z-10">
                            <div
                                class="w-10 h-10 rounded-xl bg-[#9d7cf5]/20 flex items-center justify-center mb-4 border border-[#9d7cf5]/30">
                                <svg class="w-5 h-5 text-[#c4a8ff]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                            </div>
                            <h4 class="text-white font-bold text-lg mb-2">Mejorar a Premium</h4>
                            <ul class="space-y-2 mb-6">
                                <li class="flex items-center gap-2 text-white/70 text-sm">
                                    <svg class="w-4 h-4 text-[#9d7cf5] flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Consultas ilimitadas
                                </li>
                                <li class="flex items-center gap-2 text-white/70 text-sm">
                                    <svg class="w-4 h-4 text-[#9d7cf5] flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Acceso a contexto extendido
                                </li>
                                <li class="flex items-center gap-2 text-white/70 text-sm">
                                    <svg class="w-4 h-4 text-[#9d7cf5] flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Soporte prioritario
                                </li>
                            </ul>
                            <button
                                class="w-full py-2.5 bg-[#9d7cf5] hover:bg-[#8b6ce3] rounded-xl text-sm font-semibold text-white transition-colors shadow-lg shadow-[#9d7cf5]/20"
                                onclick="Swal.fire({title: 'Próximamente', text: 'La funcionalidad Premium estará disponible pronto.', icon: 'info', confirmButtonColor: '#9d7cf5', confirmButtonText: 'Entendido', background: '#1e192c', color: '#e2dde9'})">
                                Solicitar acceso Premium
                            </button>
                        </div>
                    </div>
                </div>

                {{-- ── Tab: Términos de Uso ── --}}
                <div x-show="settingsTab === 'terminos'" class="p-8">
                    <div class="mb-6">
                        <h3 class="text-white text-base font-semibold mb-1">Términos de Uso</h3>
                        <p class="text-white/50 text-[13px]">Última actualización: 2025</p>
                    </div>
                    <div class="h-px bg-white/10 mb-6"></div>
                    <div class="text-white/70 text-sm leading-relaxed space-y-4">
                        <p>Al usar este servicio, aceptas cumplir y estar sujeto a los siguientes términos y
                            condiciones.</p>
                        <p class="text-white/40 italic">[ Aquí va el texto legal completo de los Términos de Uso.
                            Reemplaza este placeholder con el contenido real cuando esté disponible. ]</p>
                    </div>
                </div>

                {{-- ── Tab: Privacidad ── --}}
                <div x-show="settingsTab === 'privacidad'" class="p-8">
                    <div class="mb-6">
                        <h3 class="text-white text-base font-semibold mb-1">Política de Privacidad</h3>
                        <p class="text-white/50 text-[13px]">Última actualización: 2025</p>
                    </div>
                    <div class="h-px bg-white/10 mb-6"></div>
                    <div class="text-white/70 text-sm leading-relaxed space-y-4">
                        <p>Tu privacidad es importante para nosotros. Esta política explica cómo recopilamos, usamos y
                            protegemos tu información.</p>
                        <p class="text-white/40 italic">[ Aquí va el texto legal completo de la Política de Privacidad.
                            Reemplaza este placeholder con el contenido real cuando esté disponible. ]</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- ── Fin Modal de Configuración ── --}}

</div>

{{-- internal_id: ORMS_PROJ__KERMINT --}}

