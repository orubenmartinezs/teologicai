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
    $bgGradient = 'bg-obsidian-950';
    $sidebarBg = 'bg-[#090510]/85 backdrop-blur-xl';
    $sidebarBorder = 'border-white/[0.06]';
    $textColor = 'text-slate-100';
    $mutedText = 'text-slate-400';
    $aiBubbleBg = 'glass-card text-slate-100 shadow-xl';
    $aiText = 'text-[#e9dff2] text-[14.5px]';
    $userBubbleBg = 'bg-gradient-to-r from-purple-600 via-amethyst-600 to-fuchsia-600 text-white shadow-lg shadow-purple-600/30 border border-purple-400/30';
    $userText = 'text-white';
    $accent = 'text-amethyst-400';
    $title = 'TheoLogic AI';
    $inputBg = 'glass-input-box';
    $inputText = 'text-slate-100';
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
            background: '#16111e',
            color: '#e9dff2',
            iconColor: '#c084fc'
        });
    }
}"
    class="flex h-screen bg-[#07040d] text-slate-100 font-sans overflow-hidden relative select-none">

    <!-- Ambient Radial Light Glows (from Google Stitch) -->
    <div class="pointer-events-none absolute -top-40 right-1/4 w-[650px] h-[650px] bg-purple-700/15 rounded-full blur-[130px]"></div>
    <div class="pointer-events-none absolute top-1/3 right-10 w-[450px] h-[450px] bg-fuchsia-600/10 rounded-full blur-[120px]"></div>
    <div class="pointer-events-none absolute bottom-0 left-1/3 w-[550px] h-[400px] bg-violet-900/15 rounded-full blur-[120px]"></div>

    <!-- Overlay Móvil -->
    <div x-show="sidebarOpen" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-40 md:hidden"
        @click="sidebarOpen = false" x-transition.opacity></div>

    <!-- Sidebar / Bottom Sheet -->
    <aside
        class="
            flex flex-col justify-between z-50 flex-shrink-0 transition-transform duration-300
            fixed inset-x-0 bottom-0 h-[85vh] bg-[#0c0817]/95 backdrop-blur-2xl rounded-t-[32px] p-5 shadow-[0_-10px_40px_rgba(0,0,0,0.7)]
            md:relative md:w-[280px] md:h-auto md:bg-[#090510]/85 md:backdrop-blur-xl md:p-4 md:rounded-none md:shadow-none md:translate-y-0 md:flex relative z-20
        "
        :class="sidebarOpen ? 'translate-y-0' : 'translate-y-full md:translate-y-0'">
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- App Logo (Google Stitch Diamond Gem) -->
            <div class="flex items-center justify-between px-1.5 pt-1 mb-6">
                <div class="flex items-center gap-2.5 cursor-pointer">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-purple-600 via-fuchsia-400 to-white flex items-center justify-center p-[1px] shadow-sm shadow-purple-500/40">
                        <div class="w-full h-full bg-[#0d071a] rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-purple-200 fill-current" viewBox="0 0 24 24">
                                <path d="M12 2L14.4 9.6L22 12L14.4 14.4L12 22L9.6 14.4L2 12L9.6 9.6L12 2Z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[15px] font-semibold tracking-wide text-white leading-tight">Teologic.AI</span>
                        <span class="text-[10px] text-purple-300/70 font-medium tracking-wide">Workspace RAG</span>
                    </div>
                </div>
                <button aria-label="Collapse Sidebar" class="md:hidden p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition-colors" @click="sidebarOpen = false" type="button">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- + New Chat Action Button -->
            <button wire:click="startNewChat"
                class="w-full h-10 px-3.5 rounded-xl bg-white/[0.06] hover:bg-white/[0.11] active:scale-[0.99] border border-white/[0.08] flex items-center gap-2.5 text-xs font-medium text-slate-200 transition-all shadow-sm mb-4 group cursor-pointer"
                wire:loading.attr="disabled">
                <div class="w-4 h-4 rounded-full border border-purple-400/60 flex items-center justify-center text-purple-300">
                    <span class="text-xs leading-none pb-0.5">+</span>
                </div>
                <span class="text-[13px] font-medium text-slate-200 group-hover:text-white transition-colors">Nuevo Chat</span>
            </button>

            <!-- Search Chats -->
            <div class="relative px-1 mb-4">
                <svg class="w-3.5 h-3.5 absolute left-3.5 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" wire:model.live="searchChat" placeholder="Buscar chat..."
                    class="w-full bg-white/[0.03] border border-white/[0.08] text-slate-200 text-xs rounded-xl pl-8 pr-3 py-2 focus:ring-1 focus:ring-purple-500/50 focus:border-purple-500/50 focus:outline-none placeholder-slate-500 transition-all">
            </div>

            <!-- Chat History -->
            <div class="px-1 flex-1 overflow-y-auto custom-scrollbar space-y-4">

                @php
                    $pinnedChats = collect($this->chats ?? [])->where('is_pinned', true);
                    $recentChats = collect($this->chats ?? [])->where('is_pinned', false);
                @endphp

                @if ($pinnedChats->count() > 0)
                    <!-- Favoritos -->
                    <div>
                        <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-1.5 px-2">Favoritos</p>
                        <div class="space-y-0.5">
                            @foreach ($pinnedChats as $chat)
                                <div class="relative group flex items-center w-full">
                                    <button wire:click="selectChat({{ $chat->id }})"
                                        class="w-full flex items-center gap-2.5 px-2.5 py-2 rounded-xl text-xs {{ ($activeChatId ?? null) === $chat->id ? 'bg-white/[0.06] border border-purple-500/30 text-purple-200 shadow-sm font-semibold' : 'hover:bg-white/[0.04] text-slate-300 hover:text-white font-medium' }} transition-colors text-left pr-16 truncate">
                                        <svg class="w-3.5 h-3.5 text-purple-400 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                        </svg>
                                        <span class="truncate flex-1">{{ $chat->title }}</span>
                                    </button>

                                    <!-- Hover Actions -->
                                    <div class="absolute right-1.5 opacity-0 group-hover:opacity-100 flex items-center gap-1 transition-opacity bg-[#0c0817] pl-1.5 rounded-lg py-1 shadow-[-8px_0_8px_#0c0817]">
                                        <button wire:click.stop="togglePinChat({{ $chat->id }})"
                                            class="p-1 rounded-md hover:bg-white/10 text-purple-300 transition-colors"
                                            title="Quitar de favoritos">
                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                            </svg>
                                        </button>
                                        <button wire:click.stop="deleteChat({{ $chat->id }})"
                                            class="p-1 rounded-md hover:bg-red-500/20 text-red-400 transition-colors"
                                            title="Eliminar chat">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
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
                    <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-1.5 px-2">Recientes</p>
                    <div class="space-y-0.5">
                        @foreach ($recentChats as $chat)
                            <div class="relative group flex items-center w-full">
                                <button wire:click="selectChat({{ $chat->id }})"
                                    class="w-full flex items-center gap-2.5 px-2.5 py-2 rounded-xl text-xs {{ ($activeChatId ?? null) === $chat->id ? 'bg-white/[0.06] border border-purple-500/30 text-purple-200 shadow-sm font-semibold' : 'hover:bg-white/[0.04] text-slate-300 hover:text-white font-medium' }} transition-colors text-left pr-16 truncate">
                                    <svg class="w-3.5 h-3.5 text-slate-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    <span class="truncate flex-1">{{ $chat->title }}</span>
                                </button>

                                <!-- Hover Actions -->
                                <div class="absolute right-1.5 opacity-0 group-hover:opacity-100 flex items-center gap-1 transition-opacity bg-[#0c0817] pl-1.5 rounded-lg py-1 shadow-[-8px_0_8px_#0c0817]">
                                    <button wire:click.stop="togglePinChat({{ $chat->id }})"
                                        class="p-1 rounded-md hover:bg-white/10 text-slate-400 hover:text-white transition-colors"
                                        title="Añadir a favoritos">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                        </svg>
                                    </button>
                                    <button wire:click.stop="deleteChat({{ $chat->id }})"
                                        class="p-1 rounded-md hover:bg-red-500/20 text-slate-400 hover:text-red-400 transition-colors"
                                        title="Eliminar chat">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                        @if ($recentChats->count() === 0 && $pinnedChats->count() === 0)
                            <p class="text-xs text-slate-500 px-2 italic">No hay conversaciones aún.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Bottom Card: Upgrade to Premium (Google Stitch Crown Card) -->
            <div class="mt-4 rounded-2xl p-3.5 bg-gradient-to-b from-white/[0.06] to-white/[0.02] border border-white/[0.08] shadow-lg text-center relative overflow-hidden">
                <div class="pointer-events-none absolute -top-8 left-1/2 -translate-x-1/2 w-28 h-28 bg-purple-500/20 rounded-full blur-2xl"></div>
                <div class="w-7 h-7 rounded-full bg-white/[0.08] border border-white/10 mx-auto flex items-center justify-center text-purple-300 mb-2">
                    <svg class="w-3.5 h-3.5 fill-none stroke-current" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M3 18h18M3 14l3.5-5 5.5 5 5.5-5 3.5 5H3z" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <h4 class="text-xs font-semibold text-white tracking-tight">Mejorar a Premium</h4>
                <p class="text-[11px] leading-tight text-slate-400 mt-1 px-1">
                    Impulsa tus consultas con IA avanzada y capacidades ilimitadas.
                </p>
                <button
                    class="mt-2.5 w-full py-1.5 px-3 rounded-xl bg-white/[0.08] hover:bg-white/[0.14] active:scale-[0.98] border border-white/[0.1] text-xs font-medium text-slate-100 transition-all cursor-pointer"
                    onclick="Swal.fire({title: 'Promoción Exclusiva', text: 'Esta es una funcionalidad de demostración de Alpha.', icon: 'info', confirmButtonColor: '#9333ea', confirmButtonText: 'Entendido', background: '#16111e', color: '#e9dff2'})">
                    Mejorar Plan
                </button>
            </div>
        </div>
    </aside>

    <!-- Chat Area (Obsidian Violet Glass Stage) -->
    <div
        class="flex-1 flex flex-col justify-between relative w-full overflow-hidden z-10 rounded-none md:rounded-l-[36px] border-none md:border-solid md:border-l md:border-y md:border-white/[0.08] bg-obsidian-950/70 backdrop-blur-2xl">

        <!-- Top Header Navigation Bar (from Google Stitch) -->
        <header class="h-16 px-6 md:px-8 flex items-center justify-between z-10 pt-4 pb-2 border-b border-white/[0.06]">
            <div class="flex items-center gap-3">
                <button class="md:hidden p-2 rounded-xl text-slate-300 hover:text-white hover:bg-white/5 transition-colors" @click="sidebarOpen = true">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Model Selector Pill Button (from Stitch) -->
                <div class="relative">
                    <button class="glass-pill px-3.5 py-1.5 rounded-full flex items-center gap-2 text-xs font-medium text-slate-200 hover:text-white transition-colors shadow-sm" type="button">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,0.8)] animate-pulse"></span>
                        <span class="font-semibold tracking-wide">Teologic RAG AI</span>
                        <span class="text-[10px] px-1.5 py-0.5 rounded-md bg-purple-500/20 text-purple-300 font-mono">v4.0</span>
                    </button>
                </div>
            </div>

            <!-- Buscador Centrado -->
            <div class="hidden sm:flex flex-1 justify-center max-w-md w-full px-4">
                <div class="relative w-full" x-data>
                    <input type="text" x-model="intraSearch" @keyup.enter="findInChat()"
                        placeholder="Buscar en la conversación..."
                        class="glass-pill w-full py-1.5 pl-9 pr-4 text-xs text-slate-200 placeholder-slate-400 focus:outline-none focus:border-purple-400/50 focus:ring-1 focus:ring-purple-400/40 rounded-full transition-all">
                    <svg class="w-3.5 h-3.5 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="flex items-center gap-2.5">
                <!-- Configuration Button (from Stitch) -->
                <button @click="openSettings('perfil')"
                    class="glass-pill px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs text-slate-300 hover:text-white transition-colors cursor-pointer" type="button">
                    <span class="hidden md:inline">Configuración</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>

                <!-- Profile Dropdown -->
                <div class="relative">
                    <button @click="showProfileMenu = !showProfileMenu"
                        class="flex items-center hover:ring-2 hover:ring-purple-400/40 rounded-full p-0.5 transition-all">
                        @if (auth()->check())
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6b21a8&color=fff"
                                class="w-8 h-8 rounded-full border border-purple-400/30 shadow-sm">
                        @else
                            <div class="w-8 h-8 rounded-full border border-purple-400/30 shadow-sm bg-purple-900/60 flex items-center justify-center text-white text-xs font-semibold">
                                GA
                            </div>
                        @endif
                    </button>

                    <div x-show="showProfileMenu" @click.away="showProfileMenu = false"
                        class="absolute right-0 mt-2 w-60 glass-panel border border-white/10 text-white shadow-2xl rounded-2xl py-3 z-50 overflow-hidden"
                        style="display: none;">
                        @if (auth()->check())
                            <div class="flex flex-col items-center pb-2 px-4 mt-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6b21a8&color=fff&size=64"
                                    class="w-14 h-14 rounded-full border border-purple-400/30 shadow-sm mb-2.5">
                                <span class="font-semibold text-[13px] text-white/95 text-center">{{ auth()->user()->name }}</span>
                                <span class="text-[11px] text-slate-400 text-center truncate w-full">{{ auth()->user()->email }}</span>
                            </div>
                            <div class="w-full h-px bg-white/[0.08] my-2"></div>
                        @endif
                        <button @click="openSettings('perfil')"
                            class="w-full text-left px-4 py-2.5 text-[13px] text-slate-200 hover:text-white hover:bg-white/[0.06] flex items-center gap-2.5 transition-colors">
                            <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Configuración
                        </button>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2.5 text-[13px] text-rose-400 hover:text-rose-300 hover:bg-white/[0.06] flex items-center gap-2.5 transition-colors">
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

        <!-- Main Workspace Stage / Chat Scrollable Container -->
        <main class="flex-1 overflow-y-auto px-4 md:px-20 lg:px-28 py-6 space-y-6" id="chat-container" x-data
            x-init="$watch('$wire.messages', () => { setTimeout(() => $el.scrollTo({ top: $el.scrollHeight, behavior: 'smooth' }), 50) })">
            
            @if (count($messages) === 1)
                <!-- Welcome Screen / Hero Stage (from Google Stitch) -->
                <div class="mt-4 md:mt-6 max-w-3xl mx-auto w-full flex flex-col items-center text-center">
                    <!-- 3D Glowing Purple Orb -->
                    <div class="relative mb-5 flex items-center justify-center">
                        <div class="w-20 h-20 rounded-full shadow-glow-orb relative flex items-center justify-center overflow-hidden bg-gradient-to-tr from-purple-800 via-fuchsia-600 to-indigo-300 border border-fuchsia-300/40">
                            <!-- Fluid Highlights on Sphere -->
                            <div class="absolute -top-3 -right-2 w-12 h-12 bg-white/45 rounded-full blur-[4px]"></div>
                            <div class="absolute bottom-1 left-2 w-10 h-10 bg-purple-950/70 rounded-full blur-[6px]"></div>
                            <div class="absolute inset-0 bg-radial from-transparent via-purple-600/30 to-black/60"></div>
                        </div>
                    </div>

                    <!-- Headline -->
                    <h1 class="text-2xl md:text-3xl font-bold text-white tracking-tight drop-shadow-md mb-2">
                        ¿Listo para crear algo nuevo en tu ministerio?
                    </h1>
                    <p class="text-xs md:text-sm text-slate-400 max-w-lg mb-8 leading-relaxed">
                        Explora la teología bíblica, bosqueja mensajes homiléticos y consulta las Escrituras con el poder de RAG verificado.
                    </p>

                    <!-- Suggestion Action Pills Row (from Stitch) -->
                    <div class="flex flex-wrap items-center justify-center gap-2.5 mb-8">
                        <button wire:click="setPromptAndSend('Realiza un análisis exegético y teológico de Romanos 8:28-30 en su contexto original')"
                            class="glass-pill px-3.5 py-1.5 rounded-full flex items-center gap-2 text-xs font-medium text-slate-300 hover:text-white hover:border-purple-500/40 transition-all active:scale-95" type="button">
                            <span>Exégesis Romanos 8</span>
                            <svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </button>
                        <button wire:click="setPromptAndSend('Diseña un bosquejo homilético expositivo de 3 puntos sobre la gracia en Efesios 2:8-10')"
                            class="glass-pill px-3.5 py-1.5 rounded-full flex items-center gap-2 text-xs font-medium text-slate-300 hover:text-white hover:border-purple-500/40 transition-all active:scale-95" type="button">
                            <span>Bosquejo Homilético</span>
                            <svg class="w-3.5 h-3.5 text-amber-300/80" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </button>
                        <button wire:click="setPromptAndSend('¿Qué principios bíblicos y doctrinales guían la consejería pastoral en momentos de aflicción?')"
                            class="glass-pill px-3.5 py-1.5 rounded-full flex items-center gap-2 text-xs font-medium text-slate-300 hover:text-white hover:border-purple-500/40 transition-all active:scale-95" type="button">
                            <span>Consejería y Doctrina</span>
                            <svg class="w-3.5 h-3.5 text-fuchsia-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Bottom Feature Cards Grid (from Stitch) -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3.5 w-full text-left">
                        <!-- Card 1 -->
                        <div wire:click="setPromptAndSend('Explícame el significado de la palabra Shalom en el Antiguo Testamento')"
                            class="glass-card rounded-2xl p-4 transition-all duration-200 cursor-pointer group hover:border-purple-500/40 hover:-translate-y-0.5">
                            <div class="flex items-center justify-between mb-2.5">
                                <div class="w-7 h-7 rounded-lg bg-white/[0.06] flex items-center justify-center text-purple-300 group-hover:text-purple-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <span class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Hermenéutica</span>
                            </div>
                            <h3 class="text-xs font-semibold text-white group-hover:text-purple-200 transition-colors">Exégesis Bíblica</h3>
                            <p class="text-[11px] text-slate-400 mt-1 line-clamp-2">Idiomas originales (hebreo, arameo, griego) y contexto histórico-gramatical.</p>
                        </div>

                        <!-- Card 2 -->
                        <div wire:click="setPromptAndSend('Proponme 3 ideas de sermones para una serie sobre el Fruto del Espíritu')"
                            class="glass-card rounded-2xl p-4 transition-all duration-200 cursor-pointer group hover:border-purple-500/40 hover:-translate-y-0.5">
                            <div class="flex items-center justify-between mb-2.5">
                                <div class="w-7 h-7 rounded-lg bg-white/[0.06] flex items-center justify-center text-amber-300 group-hover:text-amber-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <span class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Predicación</span>
                            </div>
                            <h3 class="text-xs font-semibold text-white group-hover:text-purple-200 transition-colors">Preparación Homilética</h3>
                            <p class="text-[11px] text-slate-400 mt-1 line-clamp-2">Bosquejos expositivos, aplicaciones prácticas e ilustraciones pastorales.</p>
                        </div>

                        <!-- Card 3 -->
                        <div wire:click="setPromptAndSend('¿Cuáles son los principales debates históricos sobre la doctrina de la justificación por la fe?')"
                            class="glass-card rounded-2xl p-4 transition-all duration-200 cursor-pointer group hover:border-purple-500/40 hover:-translate-y-0.5">
                            <div class="flex items-center justify-between mb-2.5">
                                <div class="w-7 h-7 rounded-lg bg-white/[0.06] flex items-center justify-center text-fuchsia-300 group-hover:text-fuchsia-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                                <span class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Doctrina</span>
                            </div>
                            <h3 class="text-xs font-semibold text-white group-hover:text-purple-200 transition-colors">Teología Sistemática</h3>
                            <p class="text-[11px] text-slate-400 mt-1 line-clamp-2">Credos históricos, teología reformada y análisis dogmático fundamentado.</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Chat Messages Loop -->
            <div class="max-w-3xl mx-auto space-y-6">
                @foreach ($messages as $index => $message)
                    @if ($index !== 0)
                        @if ($message['role'] === 'user')
                            <!-- User Message Bubble (Vibrant Amethyst Gradient) -->
                            <div class="flex justify-end">
                                <div class="bg-gradient-to-r from-purple-600 via-amethyst-600 to-fuchsia-600 text-white px-5 py-3.5 rounded-2xl rounded-tr-sm max-w-2xl text-[14px] font-medium leading-relaxed shadow-lg shadow-purple-600/25">
                                    {{ $message['content'] }}
                                </div>
                            </div>
                        @else
                            <!-- Assistant Message Bubble (Glass Card with Verified Badge) -->
                            <div class="flex justify-start">
                                <div class="glass-card rounded-2xl p-5 md:p-6 max-w-3xl border border-white/10 bg-[#161023]/75 backdrop-blur-xl text-slate-100 shadow-xl shadow-purple-950/20 leading-relaxed w-full">
                                    <div class="flex items-center justify-between mb-3 border-b border-white/[0.06] pb-2.5">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-lg bg-gradient-to-tr from-purple-600 to-fuchsia-500 flex items-center justify-center text-white shadow-sm shadow-purple-500/30">
                                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M12 2L14.2 9.8L22 12L14.2 14.2L12 22L9.8 14.2L2 12L9.8 9.8L12 2Z"/>
                                                </svg>
                                            </div>
                                            <span class="text-xs font-semibold text-purple-200 tracking-wide">Teologic AI</span>
                                            <span class="text-[10px] px-2 py-0.5 rounded-full bg-purple-500/15 border border-purple-500/25 text-purple-300 font-mono">RAG Verificado</span>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <button @click="copyText(`{{ addslashes($message['content']) }}`)"
                                                class="p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition-colors cursor-pointer"
                                                title="Copiar respuesta">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </button>
                                            <!-- Artifact: Exportar a Markdown -->
                                            <button wire:click="exportToMarkdown({{ $index }})"
                                                class="px-2 py-1 rounded-lg bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white transition-colors flex items-center gap-1 text-[11px] font-medium cursor-pointer"
                                                title="Exportar a Markdown">
                                                <svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                    </path>
                                                </svg>
                                                <span>Markdown</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="prose prose-invert prose-purple prose-sm md:prose-base text-slate-200 max-w-none">
                                        {!! Str::markdown($message['content']) !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>

            <div id="bottom-spacer" class="h-6"></div>
        </main>

        <!-- Input Area (Master Floating Prompt Composer) -->
        <div class="px-4 md:px-20 lg:px-28 pb-5 pt-2 w-full relative z-20">
            <div class="max-w-3xl mx-auto relative" x-data="{
                statuses: ['Analizando consulta...', 'Buscando en la base de conocimientos RAG...', 'Confeccionando respuesta ministerial...'],
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
                    class="absolute -top-7 left-4 text-xs font-medium text-purple-300 flex items-center gap-2 animate-pulse">
                    <span class="w-2 h-2 rounded-full bg-purple-400 animate-ping"></span>
                    <span x-text="statuses[currentStatus]">Teologic AI está pensando...</span>
                </div>

                <form wire:submit.prevent="sendMessage" class="relative group">
                    <div class="glass-input-box rounded-3xl p-3 sm:p-4 transition-all">
                        <!-- Input Field with AI Sparkle Icon -->
                        <div class="flex items-start gap-3">
                            <div class="mt-1 text-purple-400 shrink-0">
                                <svg class="w-5 h-5 fill-current filter drop-shadow-[0_0_8px_rgba(192,132,252,0.8)]" viewBox="0 0 24 24">
                                    <path d="M12 2L14.2 9.8L22 12L14.2 14.2L12 22L9.8 14.2L2 12L9.8 9.8L12 2Z"></path>
                                </svg>
                            </div>
                            <textarea wire:model="prompt" rows="1" x-data="{
                                resize() {
                                    $el.style.height = '36px';
                                    $el.style.height = Math.min($el.scrollHeight, 180) + 'px';
                                }
                            }" x-init="resize()" @input="resize()"
                                @keydown.enter.prevent="if(!$event.shiftKey) { $el.closest('form').dispatchEvent(new Event('submit', { bubbles: true, cancelable: true })); $el.style.height='36px'; }"
                                placeholder="Escribe tu consulta teológica o pastoral..." wire:loading.attr="disabled" wire:target="sendMessage"
                                class="w-full bg-transparent border-0 p-0 text-sm text-slate-100 placeholder-slate-400 focus:ring-0 focus:outline-none resize-none leading-relaxed disabled:opacity-50"></textarea>
                        </div>

                        <!-- Bottom Action Toolbar inside Input Box -->
                        <div class="flex items-center justify-between pt-2 border-t border-white/[0.04] mt-2">
                            <!-- Left Action Tools -->
                            <div class="flex items-center gap-1 sm:gap-2">
                                <button type="button" @click="openSettings('perfil')"
                                    class="flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium text-slate-400 hover:text-slate-200 hover:bg-white/5 transition-colors">
                                    <svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                    <span class="hidden sm:inline">RAG Teológico</span>
                                </button>
                                <span class="text-[11px] text-slate-500 font-mono hidden md:inline">Shift + Enter para salto de línea</span>
                            </div>

                            <!-- Right Controls: Submit Send Button -->
                            <div class="flex items-center gap-2">
                                <button type="submit" aria-label="Enviar prompt"
                                    class="w-8 h-8 rounded-full bg-gradient-to-tr from-purple-600 to-fuchsia-500 hover:from-purple-500 hover:to-fuchsia-400 text-white flex items-center justify-center shadow-md shadow-purple-600/40 active:scale-95 transition-all disabled:opacity-40 disabled:cursor-not-allowed"
                                    wire:loading.attr="disabled" wire:target="sendMessage">
                                    <svg wire:loading.remove wire:target="sendMessage" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                        <path d="M5 10l7-7m0 0l7 7m-7-7v18" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <svg wire:loading wire:target="sendMessage" class="w-4 h-4 animate-spin text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <p class="text-center text-[11px] text-slate-500 mt-3 font-medium tracking-wide">
                    Teologic AI puede cometer imprecisiones. Verifica las citas bíblicas y fuentes doctrinales.
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
        {{-- Panel principal del Modal (Obsidian Violet Glass) --}}
        <div class="relative glass-panel bg-[#120a1f]/95 border border-white/10 rounded-3xl shadow-2xl w-full max-w-3xl max-h-[85vh] flex overflow-hidden backdrop-blur-2xl"
            @click.stop x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95">

            {{-- ─── Barra lateral izquierda (navegación de pestañas) ─── --}}
            <nav class="w-56 flex-shrink-0 bg-[#0b0614]/90 border-r border-white/[0.08] flex flex-col py-4 overflow-y-auto">

                {{-- Título --}}
                <div class="px-5 mb-5 flex items-center gap-2">
                    <div class="w-6 h-6 rounded-lg bg-purple-600/20 border border-purple-500/30 flex items-center justify-center text-purple-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-[14px] font-semibold text-white tracking-wide">Configuración</h2>
                </div>

                {{-- Separador --}}
                <div class="h-px bg-white/[0.08] mx-4 mb-3"></div>

                {{-- Enlace: Perfil --}}
                <button @click="settingsTab = 'perfil'"
                    :class="settingsTab === 'perfil' ? 'bg-purple-600/20 text-purple-200 border border-purple-500/30' :
                        'text-slate-400 hover:bg-white/5 hover:text-white border border-transparent'"
                    class="w-full text-left flex items-center gap-3 px-4 py-2.5 text-xs font-medium transition-all rounded-xl mx-2 mb-1"
                    style="width: calc(100% - 16px);">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Perfil
                </button>

                {{-- Enlace: Plan Premium --}}
                <button @click="settingsTab = 'premium'"
                    :class="settingsTab === 'premium' ? 'bg-purple-600/20 text-purple-200 border border-purple-500/30' :
                        'text-slate-400 hover:bg-white/5 hover:text-white border border-transparent'"
                    class="w-full text-left flex items-center gap-3 px-4 py-2.5 text-xs font-medium transition-all rounded-xl mx-2 mb-1"
                    style="width: calc(100% - 16px);">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    Plan Premium
                </button>

                {{-- Separador --}}
                <div class="h-px bg-white/[0.08] mx-4 my-3"></div>

                {{-- Enlace: Términos de Uso --}}
                <button @click="settingsTab = 'terminos'"
                    :class="settingsTab === 'terminos' ? 'bg-purple-600/20 text-purple-200 border border-purple-500/30' :
                        'text-slate-400 hover:bg-white/5 hover:text-white border border-transparent'"
                    class="w-full text-left flex items-center gap-3 px-4 py-2.5 text-xs font-medium transition-all rounded-xl mx-2 mb-1"
                    style="width: calc(100% - 16px);">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Términos de Uso
                </button>

                {{-- Enlace: Privacidad --}}
                <button @click="settingsTab = 'privacidad'"
                    :class="settingsTab === 'privacidad' ? 'bg-purple-600/20 text-purple-200 border border-purple-500/30' :
                        'text-slate-400 hover:bg-white/5 hover:text-white border border-transparent'"
                    class="w-full text-left flex items-center gap-3 px-4 py-2.5 text-xs font-medium transition-all rounded-xl mx-2"
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

                    {{-- CTA Card (Obsidian Violet Glass) --}}
                    <div
                        class="relative glass-card rounded-2xl bg-gradient-to-b from-purple-950/40 via-purple-900/20 to-obsidian-900/80 border border-purple-500/30 p-6 overflow-hidden shadow-xl">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-transparent pointer-events-none rounded-2xl">
                        </div>
                        <div class="relative z-10">
                            <div
                                class="w-10 h-10 rounded-xl bg-purple-600/20 flex items-center justify-center mb-4 border border-purple-500/30 text-purple-300">
                                <svg class="w-5 h-5 fill-none stroke-current"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                            </div>
                            <h4 class="text-white font-bold text-lg mb-2">Mejorar a Premium</h4>
                            <ul class="space-y-2 mb-6">
                                <li class="flex items-center gap-2 text-slate-300 text-sm">
                                    <svg class="w-4 h-4 text-purple-400 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Consultas y contexto ilimitados
                                </li>
                                <li class="flex items-center gap-2 text-slate-300 text-sm">
                                    <svg class="w-4 h-4 text-purple-400 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Biblioteca de documentos RAG extendida
                                </li>
                                <li class="flex items-center gap-2 text-slate-300 text-sm">
                                    <svg class="w-4 h-4 text-purple-400 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Soporte teológico ministerial prioritario
                                </li>
                            </ul>
                            <button
                                class="w-full py-2.5 bg-gradient-to-tr from-purple-600 to-fuchsia-500 hover:from-purple-500 hover:to-fuchsia-400 rounded-xl text-sm font-semibold text-white transition-all shadow-lg shadow-purple-600/30 cursor-pointer active:scale-[0.99]"
                                onclick="Swal.fire({title: 'Próximamente', text: 'La funcionalidad Premium estará disponible pronto.', icon: 'info', confirmButtonColor: '#9333ea', confirmButtonText: 'Entendido', background: '#16111e', color: '#e9dff2'})">
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

