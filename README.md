# MantisBTDarkMode

**A configurable dark-mode plugin for MantisBT 2.28.4.** It styles MantisBT's Ace and Bootstrap interface with a shared dark base and four color palettes.

**Created by:** Facundo Martín Mayordomo · [fmayordomo.com.ar](https://fmayordomo.com.ar)

## Palettes

| Palette | Description |
| --- | --- |
| Prefectura Blue | Graphite surfaces with calm blue accents. |
| Graphite | Neutral dark gray with muted green-blue accents. |
| Ocean | Deep blue surfaces with turquoise accents. |
| Prefectura Sand | Warm sand accents over a charcoal background, inspired by the PNA sand-colored uniform. The hex values are a visual interpretation, not an official PNA color specification. 

## Installation

1. Copy the `MantisBTDarkMode` directory into MantisBT's `plugins/` directory.
2. Open **Manage → Manage Plugins** and install **MantisBTDarkMode**.
3. Open the plugin configuration, choose a palette, and reload MantisBT.

The palette setting is **global** and applies to all users. Uninstall the plugin from **Manage Plugins** to remove its styles. The plugin does not create database tables or modify issues.

## Compatibility

- MantisBT 2.28.4
- PHP 8.4.

## Development

- `files/dark-mode.css` contains the shared interface rules.
- `files/dark-mode-*.css` contains each palette's color variables.
- `tests/preview.html` is a standalone mockup for comparing the palettes in a browser.
- `tests/smoke.php` checks palette selection and stylesheet loading. Run it with `php -d zend.assertions=1 -d assert.exception=1 tests/smoke.php`.

To add a palette, create a `dark-mode-NAME.css` file, add `NAME` to `palettes()` in `MantisBTDarkMode.php`, and add its translated label to both language files.

---

# MantisBTDarkMode

**Un plugin de modo oscuro configurable para MantisBT 2.28.4.** Aplica estilos a la interfaz Ace y Bootstrap de MantisBT con una base oscura y cuatro paletas de colores.

**Creado por:** Facundo Martín Mayordomo · [fmayordomo.com.ar](https://fmayordomo.com.ar)

## Paletas

| Paleta | Descripción |
| --- | --- |
| Azul Prefectura | Superficies grafito con acentos azules sobrios. |
| Grafito | Grises oscuros neutros con acentos verde azulados. |
| Océano | Superficies azul profundo con acentos turquesa. |
| Arena Prefectura | Acentos arena cálidos sobre fondo carbón, inspirados en el uniforme color arena de PNA. Los valores hexadecimales son una interpretación visual, no una especificación oficial de color de PNA. |

## Instalación

1. Copiá la carpeta `MantisBTDarkMode` dentro del directorio `plugins/` de MantisBT.
2. Abrí **Administrar → Gestionar plugins** e instalá **MantisBTDarkMode**.
3. Entrá en la configuración del plugin, elegí una paleta y recargá MantisBT.

La paleta se configura de forma **global** y se aplica a todos los usuarios. Para quitar los estilos, desinstalá el plugin desde **Gestionar plugins**. El plugin no crea tablas en la base de datos ni modifica incidencias.

## Compatibilidad

- MantisBT 2.28.4
- PHP 8.4.

## Desarrollo

- `files/dark-mode.css` contiene las reglas comunes de la interfaz.
- `files/dark-mode-*.css` contiene las variables de color de cada paleta.
- `tests/preview.html` es una maqueta independiente para comparar las paletas en un navegador.
- `tests/smoke.php` comprueba la selección de paletas y la carga de hojas de estilo. Ejecutala con `php -d zend.assertions=1 -d assert.exception=1 tests/smoke.php`.

Para agregar una paleta, creá un archivo `dark-mode-NOMBRE.css`, agregá `NOMBRE` a `palettes()` en `MantisBTDarkMode.php` y sumá su etiqueta traducida en los dos archivos de idioma.

