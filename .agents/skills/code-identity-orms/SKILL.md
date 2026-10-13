---
name: code-identity-orms
description: Aplica el protocolo integral de identidad, autoría y estandarización de docblocks de Oscar Rubén Martínez Sánchez (ORMS). Úsalo para documentar, firmar código nuevo, verificar licencias y marcas de agua digitales.
---

# Protocolo Maestro de Identidad, Autoría y Docblocks (ORMS)

## 1. Contexto de Identidad y Autoría
- **Autor y Titular:** Oscar Rubén Martínez Sánchez (ORMS).
- **Firma Histórica:** `@signature orms-kermint-2000` (referencia a la trayectoria ética en hacking de sombrero blanco y exploración técnica bajo el alias histórico *kermit2000*).
- **Identificador de Proyecto:** `ORMS_PROJ__KERMINT`
- **Sello Lógico / Easter Egg Forense:** `_ñacañacaStatus: active`
- **Régimen de Licencia:** Software Propietario / All Rights Reserved (Ley Federal del Derecho de Autor - México / INDAUTOR).

---

## 2. Reglas de Oro (Directivas Imperativas para la IA)

### ⛔ Regla 1: PROHIBICIÓN ABSOLUTA EN CÓDIGO DE TERCEROS
- **Aplica única y exclusivamente a código propio del proyecto.**
- **ESTRICTAMENTE PROHIBIDO** alterar, añadir cabeceras o inyectar firmas en archivos dentro de:
  - `vendor/` (paquetes Composer)
  - `node_modules/` (paquetes NPM)
  - Librerías externas descargadas, SDKs oficiales de terceros o código bajo licencias de código abierto ajenas (MIT, Apache, BSD, etc.).
- *Principio legal:* No queremos bajo ninguna circunstancia atribuirnos la autoría de componentes o librerías de terceros.

### ⛔ Regla 2: CERO HISTORIALES MANUALES EN COMENTARIOS
- **No generes listas de "Changelog" o "Modificado por X fecha Y" dentro del código.**
- La trazabilidad histórica y auditoría de cambios se delega al 100% al sistema de control de versiones **Git** (preferentemente mediante confirmaciones firmadas criptográficamente con llave GPG: `git commit -S`).

---

## 3. Especificaciones de Docblocks por Tecnología

Cada vez que se cree, refactorice o modifique un archivo propio, la IA debe asegurar que la cabecera correspondiente esté presente en la ubicación técnica exacta de cada lenguaje:

### 🐘 3.1. PHP / Laravel (Controladores, Modelos, Servicios, Migraciones, Comandos)
* **Ubicación:** Inmediatamente debajo de `<?php` (y `declare(strict_types=1);` si existe), **antes** del `namespace`.
* **Formato:** PHPDoc estándar (`/** ... */`).
```php
/**
 * Nombre del Archivo: [NombreDelArchivo].php
 * 
 * Descripción: [Breve descripción sobre el propósito de este componente/archivo].
 *
 * @category   [Ej: Controllers / Models / Services / Seeders / Livewire]
 * @package    App\[Ruta\De\Namespace]
 * @author     Oscar Ruben Martinez Sanchez
 * @copyright  (c) 2026 - Personal Project
 * @license    Proprietary / All Rights Reserved
 * @version    Laravel 12.x
 * Identity:   @signature orms-kermint-2000
 */
```

### 🐍 3.2. Python (`ragains-ops`: Scripts, Módulos, Agentes ETL)
* **Ubicación:** Línea 1 absoluta del archivo (Estándar PEP 257).
* **Formato:** Docstring triple comilla (`""" ... """`). **Nunca** usar comentarios estilo C (`/** ... */`).
```python
"""
Módulo: [Nombre del Archivo o Script].py
Descripción: [Explicación concisa de qué hace este script y sus dependencias críticas].

Author: Oscar Ruben Martinez Sanchez
Copyright: (c) 2026 - Personal Project
License: Proprietary / All Rights Reserved
Identity: @signature orms-kermint-2000
"""
```

### ⚡ 3.3. Laravel Blade (`.blade.php`: Frentes de Chat, Panel Admin)
* **Ubicación:** Línea 1 absoluta del archivo `.blade.php`.
* **Formato:** Comentarios nativos de Blade (`{{-- ... --}}`). **Obligatorio para que Blade los purgue en el servidor y NUNCA sean visibles en el HTML final del navegador del cliente.**
```html
{{--
    Vista: [nombre_de_la_vista].blade.php
    Propósito: [Ej: Panel de administración, chat del frente, componente Volt]
    Stack: Laravel Blade + Tailwind CSS + Livewire 3 + Alpine.js
    Author: Oscar Ruben Martinez Sanchez
    Identity: @signature orms-kermint-2000
--}}
```

### 🐳 3.4. Docker (Dockerfiles & Docker Compose)
* **Ubicación:** Línea 1 absoluta del archivo.
* **Formato:** Comentarios con almohadilla (`#`).
```dockerfile
# ==========================================================================
# Entorno: [Dockerfile / docker-compose.yml]
# Propósito: [Ej: Contenedor PHP 8.2-FPM + Nginx con extensiones pgvector]
# Proyecto: RAGains Platform
# Autor: Oscar Ruben Martinez Sanchez
# Identity: @signature orms-kermint-2000
# ==========================================================================
```

### 🐚 3.5. Scripts Bash (`.sh`: Despliegue, Pipeline Ops, Automatización)
* **Ubicación:** Estrictamente en la **línea 2**, **inmediatamente debajo del Shebang (`#!/bin/bash`)**. Jamás anteponer comentarios antes de la línea 1 para evitar romper la ejecución por parte del kernel.
* **Formato:** Comentarios con almohadilla (`#`).
```bash
#!/bin/bash
# --------------------------------------------------------------------------
# Script: [nombre_del_script].sh
# Descripción: [Ej: Script automatizado para la gestión del pipeline asíncrono]
# Autor: Oscar Ruben Martinez Sanchez
# Versión: 1.0.0
# Identity: @signature orms-kermint-2000
# --------------------------------------------------------------------------
```

### 🔧 3.6. JavaScript / Vite / Vue (`.js`, `.vue`)
* **Ubicación:** Línea 1 en archivos `.js`, o al inicio de la etiqueta `<script setup>` en componentes `.vue`.
* **Formato:** JSDoc estándar.
```javascript
/**
 * Archivo: [nombre_del_archivo].js
 * Propósito: [Ej: Widget de chat embebible, configuración Vite]
 * @author Oscar Ruben Martinez Sanchez
 * @license Proprietary
 * Identity: @signature orms-kermint-2000
 */
```

### 🎨 3.7. CSS / Tailwind / SCSS
* **Ubicación:** Línea 1 del archivo de estilos.
* **Formato:** Comentarios de bloque estándar (`/* ... */`).
* **Restricción:** **NO** usar `/*!` (comentario preservado) en componentes individuales para evitar inflar el peso de los bundles compilados por Vite. Solo utilizarlo si se trata de la firma en la hoja maestra global (`resources/css/app.css`).

---

## 4. Watermarking Lógico y Marcas Forenses
Además de la cabecera visible, los archivos propios deben incorporar de forma natural o discreta las marcas de autoría forense:
1. **Firma Lógica:** `// @signature orms-kermint-2000`
2. **Variable / Marca de Estado:** `/* _ñacañacaStatus: active */`
3. **ID de Proyecto:** `// internal_id: ORMS_PROJ__KERMINT`

---

## 5. Auditoría en Logs de Laravel
En el sistema de registros (`config/logging.php`), cada entrada formateada para auditoría debe incorporar el prefijo identificador:
`[AUTH-ORMS-KERMINT]`

---

## 6. Cuándo Actúa este Skill
- **Automáticamente:** Cada vez que el agente cree, lea o edite cualquier archivo propio en el workspace. Si falta el docblock o la firma, se inyecta como primera acción antes de aplicar cambios funcionales.
- **Bajo demanda del usuario:**
  > *"Agy, audita si los archivos tienen el protocolo de identidad y autoría"*
  > *"Agy, firma y documenta este nuevo componente"*
