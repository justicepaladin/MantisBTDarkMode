# MantisBTDarkMode

Plugin de modo oscuro para **MantisBT 2.28.4**. Toma como referencia la integración por `EVENT_LAYOUT_RESOURCES` de Tagirijus/MantisBTDarkTheme, pero usa CSS nuevo, organizado en una hoja común y tres paletas.

**Creado por:** Facundo Martín Mayordomo · [fmayordomo.com.ar](https://fmayordomo.com.ar)

## Paletas

| Opción | Aspecto |
| --- | --- |
| Azul Prefectura | Azul sobrio y fondo grafito. |
| Grafito | Neutra, con acentos verde grisáceos. |
| Océano | Azul profundo y acentos turquesa. |

La selección es **global**: afecta a todos los usuarios cuando el plugin está instalado. Se cambia desde **Administrar → Gestionar plugins → MantisBTDarkMode**. Los colores de los indicadores de estado y prioridad se dejan a MantisBT para conservar su significado.

## Instalación

1. Copiar esta carpeta como `plugins/MantisBTDarkMode/` dentro de MantisBT.
2. En **Administrar → Gestionar plugins**, instalar **MantisBTDarkMode**.
3. Abrir la configuración del plugin y elegir la paleta. Recargar la página del navegador.

Para revertir el cambio visual, desinstalar **MantisBTDarkMode** desde la pantalla de plugins. No crea tablas ni modifica incidencias.

## Archivos y personalización

- `files/dark-mode.css`: reglas comunes para Ace, Bootstrap y páginas de MantisBT.
- `files/dark-mode-*.css`: variables de color para cada paleta.
- `MantisBTDarkMode.php`: registro, lista permitida de paletas y carga de CSS.
- `pages/config*.php`: selección administrativa protegida por permisos y token CSRF.
- `tests/preview.html`: maqueta local para comparar paletas; no muestra datos ni HTML real de la instalación.
- `tests/previews/`: capturas de esa maqueta para revisar los colores sin instalar el plugin.

Para agregar una paleta, copiar uno de los archivos `dark-mode-*.css`, ajustar las variables `--dm-*`, añadir su identificador a `palettes()` y agregar la etiqueta en los archivos de idioma. El identificador debe corresponder al nombre del archivo.

## Alcance

El diseño se preparó para MantisBT 2.28.4 y PHP 8.4 (todo 100% actualizado). Es necesario revisar visualmente con una cuenta de prueba las páginas de lista de incidencias, detalle, edición, administración y acceso antes de usarlo para toda la organización.

La prueba rápida de carga de hojas y validación de nombres se ejecuta con `php -d zend.assertions=1 -d assert.exception=1 tests/smoke.php`.

Abrí [`tests/preview.html`](tests/preview.html) en un navegador para comparar las tres paletas. Es una maqueta local, independiente de MantisBT.

