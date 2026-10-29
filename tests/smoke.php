<?php

/* Run with: php tests/smoke.php */
class MantisPlugin {}

$palette = 'prefectura';
function plugin_config_get( $name, $default = null ) {
	global $palette;
	return $palette;
}
function plugin_file( $file ) {
	return '/plugin_file.php?file=MantisBTDarkMode/' . $file;
}

require dirname( __DIR__ ) . '/MantisBTDarkMode.php';

$plugin = new MantisBTDarkModePlugin();
assert( $plugin->config()['palette'] === 'prefectura' );
assert( $plugin->hooks()['EVENT_LAYOUT_RESOURCES'] === 'add_css' );

foreach( MantisBTDarkModePlugin::palettes() as $name ) {
	$palette = $name;
	ob_start();
	$plugin->add_css( 'EVENT_LAYOUT_RESOURCES' );
	$html = ob_get_clean();
	assert( substr_count( $html, '<link ' ) === 2 );
	assert( strpos( $html, 'dark-mode-' . $name . '.css' ) !== false );
	assert( strpos( $html, 'dark-mode.css' ) !== false );
}

$palette = '../untrusted.css';
ob_start();
$plugin->add_css( 'EVENT_LAYOUT_RESOURCES' );
$html = ob_get_clean();
assert( strpos( $html, 'dark-mode-prefectura.css' ) !== false );
assert( strpos( $html, 'untrusted' ) === false );

echo "Smoke test passed\n";
