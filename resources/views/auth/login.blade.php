<?php
/**
 * Premium login page for TheoLogic AI (Alpha).
 * Uses a glassmorphism card over a vibrant gradient background.
 * Includes Google Font 'Inter' for modern typography.
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iniciar Sesión – TheoLogic AI</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            height: 100vh;
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .glass {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 360px;
            max-width: 90%;
            color: #fff;
        }
        .glass h2 {
            margin-top: 0;
            margin-bottom: 1.5rem;
            font-weight: 600;
            text-align: center;
        }
        .glass label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            opacity: 0.9;
        }
        .glass input[type="email"],
        .glass input[type="password"] {
            width: 100%;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.25);
            color: #fff;
            font-size: 1rem;
        }
        .glass input::placeholder {
            color: rgba(255,255,255,0.7);
        }
        .glass button {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 8px;
            background: #6c63ff;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .glass button:hover {
            background: #5a54e6;
        }
        .glass .links {
            margin-top: 1rem;
            text-align: center;
            font-size: 0.85rem;
        }
        .glass .links a {
            color: #e0e0ff;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="glass">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="email">Correo electrónico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="ejemplo@correo.com" />

            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required placeholder="********" />

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <label style="display: flex; align-items: center;">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="margin-right: 0.5rem;" />
                    Recuérdame
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="color: #e0e0ff;">¿Olvidaste tu contraseña?</a>
                @endif
            </div>

            <button type="submit">Entrar</button>
        </form>
        <div class="links">
            ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a>
        </div>
    </div>
</body>
</html>
