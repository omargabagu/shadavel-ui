# Documentación de componentes

## 📦 Uso

Para poder usar un componente, descarga y pega la carpeta del componente en `resources/views/components`.

---

### 🧾 Ejemplo de uso del componente `Input`

Con descripción:

```blade
<x-input 
    description="Descripcion del input (opcional)" 
    type="text" 
    name="autor" 
    label="Texto de la etiqueta (opcional)" 
    required 
/>
```

Sin descripción:

```blade
<x-input 
    type="text" 
    name="autor" 
    required 
/>
```

---

## 🔎 Componente: `<x-select-search-tw />`

Este componente Blade genera un `<select>` con búsqueda integrada, ideal para listas grandes como áreas, categorías, usuarios, etc. Funciona 100% en Blade sin dependencias externas.

---

### ✅ Uso básico

```blade
<x-select-search-tw
    label="Área:"
    inputid="area_id"
    :required="true"
    :options="$areas"
/>
```

---

### ⚙️ Props disponibles

| Propiedad          | Tipo     | Requerido | Descripción |
|--------------------|----------|-----------|-------------|
| `label`            | string   | Opcional  | Texto de la etiqueta visible. |
| `inputid`          | string   | ✅ Sí     | ID único del input, usado también en el JS. |
| `:options`         | array    | ✅ Sí     | Lista de opciones (array o colección). Cada opción debe tener `id` y una columna para mostrar (`name` por defecto). |
| `:required`        | bool     | Opcional  | Si el campo debe ser obligatorio. |
| `displaycolumn`    | string   | Opcional  | Columna que se muestra como texto. Por defecto: `name`. |
| `nulloption`       | bool     | Opcional  | Si se muestra una opción "Ninguno". |
| `relationid`       | string   | Opcional  | ID seleccionado por defecto (para modo edición). |
| `relationdisplay`  | string   | Opcional  | Texto visible por defecto (modo edición). |

---

### ✨ Ejemplo en formulario de creación

```blade
<x-select-search-tw
    label="Área:"
    inputid="area_id"
    :required="true"
    :options="$areas"
/>
```

---

### ✏️ Ejemplo en formulario de edición

```blade
<x-select-search-tw
    label="Área:"
    inputid="area_id"
    :required="true"
    :options="$areas"
    relationid="{{ old('area_id', $post->area_id) }}"
    relationdisplay="{{ old('area_id_display', $post->area->name ?? '') }}"
/>
```

---

### 🧠 Backend — Controlador

```php
public function create()
{
    $areas = Area::select('id', 'name')->get();

    return view('posts.create', [
        'areas' => $areas,
    ]);
}
```

---

### 🔎 Funcionalidad JS incluida

- Búsqueda en vivo (soporta acentos, mayúsculas/minúsculas).
- Navegación con teclado (`↑`, `↓`, `Enter`, `Escape`).
- Oculta/abre dropdown automáticamente.
- Resalta la opción activa.
- Cierra el dropdown al hacer clic fuera.

---

¿Quieres agregar soporte para múltiples selecciones, integrarlo con Livewire o hacerlo accesible (ARIA)? ¡Abre un issue o colabora!
