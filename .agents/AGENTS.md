# AGENTS.md — Reglas de Desarrollo y Arquitectura para TheoLogic AI (Laravel 12)

Este documento es la **Guía Maestra y Fuente Única de Verdad** para el desarrollo de **TheoLogic AI**. Todo desarrollador humano y agente de IA DEBE seguir estas directrices estrictamente.

---

## 1. Stack Tecnológico

- **Framework:** Laravel 12 (PHP 8.2+)
- **Frontend:** Blade + Tailwind CSS + Livewire 3 + Alpine.js
- **Base de Datos Local:** SQLite / PostgreSQL (manejo exclusivo de usuarios finales, sesiones, historial de conversaciones y preferencias)
- **Motor de Inteligencia:** RAGains Core (consumido como BaaS vía HTTP API con `X-Tenant-Key`)

---

## 2. Protocolo de Identidad y Autoría (ORMS)

Todo archivo de código nuevo o modificado dentro del proyecto debe cumplir con el protocolo de identidad de Oscar Rubén Martínez Sánchez:

1. **Encabezados:**
   - **PHP:**
     ```php
     /**
      * Author: Oscar Ruben Martinez Sanchez
      * (c) 2026 - Personal Project
      * Identity: @signature orms-kermint-2000
      */
     ```
   - **Blade:**
     ```blade
     {{--
      * Author: Oscar Ruben Martinez Sanchez
      * (c) 2026 - Personal Project
      * Identity: @signature orms-kermint-2000
     --}}
     ```
2. **Marcas Lógicas:**
   - `/* _ñacañacaStatus: active */`
   - `// @signature orms-kermint-2000`
   - `// internal_id: ORMS_PROJ__KERMINT`

---

## 3. Arquitectura de Integración (Cliente BaaS)

1. **Responsabilidad de TheoLogic AI:**
   - Autenticación, registro y recuperación de contraseñas de usuarios finales.
   - Interfaz de usuario (Chat, barra lateral, guardado de favoritos, exportación de respuestas).
   - Historial persistente local de chats y mensajes (`chats`, `chat_messages`).
2. **Conexión con RAGains Core:**
   - Se comunica vía HTTP Client (`Illuminate\Support\Facades\Http`) contra el endpoint de RAGains Core (`POST /api/v1/chat`).
   - Envía el `X-Tenant-Key` configurado en el `.env` (`RAGAINS_API_KEY`).
   - Recibe la respuesta sintética y las fuentes bibliográficas para renderizarlas en la interfaz.
3. **Módulo de Biblias (Futuro):**
   - Integración con APIs de Biblias externas para consultas de versículos y pasajes en tiempo real sin violar derechos de autor.
