import os
import random

# CONFIGURACIÓN DE IDENTIDAD PERSONAL (ORMS)
AUTHOR = "Oscar Ruben Martinez Sanchez"
PERSONAL_SIGNATURE = "@signature orms-kermint-2000"

PHP_LICENSE_HEADER = f"""/**
 * Author: {AUTHOR}
 * (c) 2026 - Personal Project
 * Identity: {PERSONAL_SIGNATURE}
 */\n"""

BLADE_LICENSE_HEADER = f"""{{{{--
 * Author: {AUTHOR}
 * (c) 2026 - Personal Project
 * Identity: {PERSONAL_SIGNATURE}
--}}}}\n"""

# Marcas de agua lógicas con sintaxis compatible universalmente
WATERMARKS = [
    f"\n// {PERSONAL_SIGNATURE}\n",
    "\n/* _ñacañacaStatus: active */\n",
    "\n// internal_id: ORMS_PROJ__KERMINT\n",
]

EXTENSIONS = ('.php', '.js', '.vue', '.py')

def clean_and_upgrade_content(content):
    # Reemplazar versiones anteriores de firmas y marcas
    content = content.replace("Identity: @signature orms-kermint-2000", f"Identity: {PERSONAL_SIGNATURE}")
    content = content.replace("orms-kermint-2000", "orms-kermint-2000")
    content = content.replace("// @signature orms-kermint-2000", f"// {PERSONAL_SIGNATURE}")
    content = content.replace("_ñacañacaStatus: active", "_ñacañacaStatus: active")
    content = content.replace("// internal_id: ORMS_PROJ__KERMINT", "// internal_id: ORMS_PROJ__KERMINT")
    content = content.replace("// internal_id: ORMS_PROJ__KERMINT", "// internal_id: ORMS_PROJ__KERMINT")
    content = content.replace("internal_id: ORMS_PROJ__KERMINT", "internal_id: ORMS_PROJ__KERMINT")
    return content

def apply_watermark(file_path):
    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()

    # 1. Actualizar marcas antiguas si existen
    content = clean_and_upgrade_content(content)

    # 2. Verificar si ya tiene el encabezado
    has_author = AUTHOR in content[:500]

    if not has_author:
        if file_path.endswith('.blade.php'):
            content = BLADE_LICENSE_HEADER + content
        elif file_path.endswith('.php'):
            if content.startswith('<?php'):
                lines = content.split('\n', 1)
                first_line = lines[0]
                rest = lines[1] if len(lines) > 1 else ''
                content = first_line + '\n\n' + PHP_LICENSE_HEADER + rest
            else:
                content = '<?php\n\n' + PHP_LICENSE_HEADER + content
        else:
            content = PHP_LICENSE_HEADER + content

    # 3. Watermark Lógico: Verificar si tiene alguna de las marcas nuevas
    has_watermark = any(w.strip() in content for w in WATERMARKS)
    if not has_watermark:
        mark = random.choice(WATERMARKS)
        content += mark

    with open(file_path, 'w', encoding='utf-8') as f:
        f.write(content)
    print(f"[+] Protegido/Actualizado: {file_path}")

def run_protection(directory):
    for root, dirs, files in os.walk(directory):
        # Ignorar carpetas de sistema/librerías y plantillas externas
        if any(ignored in root for ignored in ['vendor', 'node_modules', '.git', 'storage', 'tailadmin-laravel-main', 'laravel-tailwindcss-admin-dashboard-template-main']):
            continue
            
        for file in files:
            if file.endswith(EXTENSIONS):
                apply_watermark(os.path.join(root, file))

if __name__ == "__main__":
    project_path = input("Introduce la ruta del proyecto a proteger: ") or "."
    run_protection(project_path)
    print("\n¡Protocolo de identidad actualizado con éxito!")
