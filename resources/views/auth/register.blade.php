<?php
/**
 * Premium registration page for TheoLogic AI (Alpha).
 * Mirrors the design of the premium login view.
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Regístrate – TheoLogic AI</title>
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
            width: 380px;
            max-width: 95%;
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
        .glass input {
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
        <h2>Crear Cuenta</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <label for="name">Nombre</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Tu nombre" />

            <label for="email">Correo electrónico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="ejemplo@correo.com" />

            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required placeholder="********" />

            <label for="password_confirmation">Confirmar Contraseña</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="********" />

            <button type="submit">Registrarse</button>
        </form>
        <div class="links">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
        </div>
    </div>
</body>
</html>
