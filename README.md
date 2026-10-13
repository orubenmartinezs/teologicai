# 📖 TheoLogic AI — Interfaz de Inteligencia Teológica

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Livewire](https://img.shields.io/badge/Livewire-3.x-FB70A9?style=for-the-badge&logo=livewire&logoColor=white)](https://livewire.laravel.com)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-v3-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)](https://alpinejs.dev)
[![RAGains Core](https://img.shields.io/badge/Powered%20By-RAGains%20Core-6366F1?style=for-the-badge)](https://github.com/orubenmartinezs/ragains)

**TheoLogic AI** es una aplicación web frontend de última generación diseñada para la consulta, investigación y estudio teológico profundo. Funciona como un cliente desacoplado que consume el motor de inteligencia y recuperación documental **RAGains Core** vía API BaaS, garantizando respuestas fidedignas, contextualizadas y fundamentadas en las Sagradas Escrituras y obras teológicas clásicas.

---

## 🏛️ Arquitectura Desacoplada

TheoLogic AI no almacena los vectores ni realiza embeddings localmente. Toda la lógica pesada de IA, búsqueda semántica y tool calling se delega al backend central:

```mermaid
graph LR
    User([Usuario / Teólogo]) -->|Interactúa| TheoLogic[TheoLogic AI (Frontend Client)]
    TheoLogic -->|POST /api/v1/chat con X-Tenant-Key| Core[RAGains Core BaaS (Backend)]
    Core -->|pgvector| DB[(PostgreSQL Embeddings)]
    Core -->|Prism-PHP / Gemini| LLM[Modelos de IA + APIs Bíblicas]
    Core -->|JSON con Fuentes + Citas| TheoLogic
    TheoLogic -->|Renderiza Respuesta + Historial| User
```

---

## ✨ Características Principales

* **🎨 Experiencia Visual Premium:** Interfaz inmersiva con estética *Glassmorphism*, paleta tonal púrpura profunda (`#312a38` / `#4d3e5b`), gradientes radiales y micro-interacciones suaves.
* **⚡ Reactividad Total con Livewire 3 y Alpine.js:** Flujo de chat en tiempo real sin recargas de página, indicadores de estado de pensamiento del asistente y gestión de scroll automático.
* **📚 Historial y Gestión de Conversaciones:**
  * Persistencia local de chats por usuario.
  * Fijación de chats favoritos con acceso rápido.
  * Búsqueda en vivo dentro de la lista de conversaciones.
  * Búsqueda intra-chat en tiempo real sobre la conversación activa.
* **📄 Exportación y Citas:**
  * Soporte completo de renderizado Markdown (citas en bloque, tablas, listas, código).
  * Botón para exportar cualquier respuesta generada directamente a archivo `.md`.
  * Copia rápida de respuestas al portapapeles con toasts informativos.
* **🔐 Seguridad y Aislamiento:** Autenticación de usuarios por sesión local y comunicación segura contra RAGains Core mediante cabeceras `X-Tenant-Key`.

---

## 🚀 Requisitos del Sistema

* PHP 8.2 o superior
* Composer
* Node.js 18+ y NPM
* SQLite o PostgreSQL / MySQL para la base de datos de usuarios e historial de chat local
* Una instancia activa de [RAGains Core](https://github.com/orubenmartinezs/ragains)

---

## 🛠️ Instalación y Puesta en Marcha

### 1. Clonar el repositorio
```bash
git clone https://github.com/orubenmartinezs/teologicai.git
cd teologicai
```

### 2. Instalar dependencias
```bash
composer install
npm install
```

### 3. Configurar variables de entorno
Copia el archivo de ejemplo y genera la clave de la aplicación:
```bash
cp .env.example .env
php artisan key:generate
```

Edita tu archivo `.env` para apuntar a tu servidor de RAGains Core:
```env
APP_NAME="TheoLogic AI"
APP_URL=http://127.0.0.1:8001

# Conexión con RAGains Core (Backend BaaS)
RAGAINS_API_URL=http://127.0.0.1:8000
RAGAINS_API_KEY=rag_tenant_theologic_ai_live_key_2026

# Base de datos local para usuarios e historial de chats
DB_CONNECTION=sqlite
```

### 4. Ejecutar migraciones
```bash
touch database/database.sqlite
php artisan migrate
```

### 5. Compilar assets y levantar el servidor
En una terminal:
```bash
npm run dev
```

En otra terminal:
```bash
php artisan serve --port=8001
```

Accede desde tu navegador a `http://127.0.0.1:8001`.

---

## 🧪 Pruebas y Validación

Para ejecutar las pruebas automatizadas del proyecto:
```bash
php artisan test
```

---

## 👤 Autor y Créditos

* **Desarrollador:** Oscar Rubén Martínez Sánchez
* **Organización:** Taranja Digital
* **Licencia:** Todos los derechos reservados / Propietario.
