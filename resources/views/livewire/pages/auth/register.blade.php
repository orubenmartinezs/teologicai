{{--
 * Author: Oscar Ruben Martinez Sanchez
 * (c) 2026 - Personal Project
 * Identity: @signature orms-kermint-2000
--}}
<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'lowercase', 'email', 'max:255', 
                \Illuminate\Validation\Rule::unique(User::class)
            ],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register" class="space-y-5">
        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-[#332b3f]/70">Nombre</label>
            <input wire:model="name" id="name" class="mt-1 block w-full bg-white/50 border border-[#332b3f]/20 rounded-xl text-[#332b3f] px-4 py-3 focus:ring-[#3a3145] focus:border-[#3a3145] placeholder-[#332b3f]/40 transition-colors" type="text" name="name" required autofocus autocomplete="name" placeholder="Juan Pérez" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-[#332b3f]/70">Correo Electrónico</label>
            <input wire:model="email" id="email" class="mt-1 block w-full bg-white/50 border border-[#332b3f]/20 rounded-xl text-[#332b3f] px-4 py-3 focus:ring-[#3a3145] focus:border-[#3a3145] placeholder-[#332b3f]/40 transition-colors" type="email" name="email" required autocomplete="username" placeholder="correo@ejemplo.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <!-- Password -->
        <div x-data="{ show: false }">
            <label for="password" class="block text-sm font-semibold text-[#332b3f]/70">Contraseña</label>
            <div class="relative mt-1">
                <input wire:model="password" id="password" :type="show ? 'text' : 'password'" class="block w-full bg-white/50 border border-[#332b3f]/20 rounded-xl text-[#332b3f] px-4 py-3 pr-10 focus:ring-[#3a3145] focus:border-[#3a3145] placeholder-[#332b3f]/40 transition-colors" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-[#332b3f]/50 hover:text-[#332b3f]">
                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <!-- Confirm Password -->
        <div x-data="{ show: false }">
            <label for="password_confirmation" class="block text-sm font-semibold text-[#332b3f]/70">Confirmar Contraseña</label>
            <div class="relative mt-1">
                <input wire:model="password_confirmation" id="password_confirmation" :type="show ? 'text' : 'password'" class="block w-full bg-white/50 border border-[#332b3f]/20 rounded-xl text-[#332b3f] px-4 py-3 pr-10 focus:ring-[#3a3145] focus:border-[#3a3145] placeholder-[#332b3f]/40 transition-colors" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-[#332b3f]/50 hover:text-[#332b3f]">
                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-[#3a3145] hover:bg-[#2e2637] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3a3145] focus:ring-offset-[#f8eedf] transition-all">
                Crear Cuenta
            </button>
        </div>
        
        <p class="text-center text-sm text-[#332b3f]/70 mt-6">
            ¿Ya tienes cuenta?
            <a class="font-bold text-[#6b6276] hover:text-[#3a3145] transition-colors" href="{{ route('login') }}" wire:navigate>
                Iniciar sesión
            </a>
        </p>
    </form>
</div>

{{-- _ñacañacaStatus: active --}}
