<?php

/* Run with: php tests/smoke.php */
class MantisPlugin {}
define( 'ALL_PROJECTS', 0 );

$palette = 'prefectura';
$mode = 'dark';
$authenticated = true;
$anonymous = false;
function auth_is_user_authenticated() {
	global $authenticated;
	return $authenticated;
}
function current_user_is_anonymous() {
	global $anonymous;
	return $anonymous;
}
function auth_get_current_user_id() {
	return 42;
}
function plugin_config_get( $name, $default = null, $global = false, $user = null, $project = null ) {
	global $palette, $mode;
	if( $name === 'mode' ) {
		assert( $user === 42 && $project === ALL_PROJECTS );
		return $mode;
	}
	return $palette;
}
function plugin_file( $file ) {
	return '/plugin_file.php?file=MantisBTDarkMode/' . $file;
}
function plugin_page( $page ) {
	return '/plugin.php?page=MantisBTDarkMode/' . $page;
}
function plugin_lang_get( $name ) {
	return $name;
}
function form_security_field( $name ) {
	return '<input type="hidden" name="token" value="test">';
}

require dirname( __DIR__ ) . '/MantisBTDarkMode.php';

$plugin = new MantisBTDarkModePlugin();
assert( $plugin->config()['palette'] === 'prefectura' );
assert( $plugin->config()['mode'] === 'dark' );
assert( $plugin->hooks()['EVENT_LAYOUT_RESOURCES'] === 'add_css' );
assert( $plugin->hooks()['EVENT_LAYOUT_PAGE_HEADER'] === 'render_toggle' );

foreach( MantisBTDarkModePlugin::palettes() as $name ) {
	$palette = $name;
	ob_start();
	$plugin->add_css( 'EVENT_LAYOUT_RESOURCES' );
	$html = ob_get_clean();
	assert( substr_count( $html, '<link ' ) === 3 );
	assert( strpos( $html, 'dark-mode-' . $name . '.css' ) !== false );
	assert( strpos( $html, 'dark-mode.css' ) !== false );
	assert( strpos( $html, 'toggle.css' ) !== false );
	assert( strpos( $html, 'toggle.js' ) !== false );
}

$palette = '../untrusted.css';
ob_start();
$plugin->add_css( 'EVENT_LAYOUT_RESOURCES' );
$html = ob_get_clean();
assert( strpos( $html, 'dark-mode-prefectura.css' ) !== false );
assert( strpos( $html, 'untrusted' ) === false );

$mode = 'light';
ob_start();
$plugin->add_css( 'EVENT_LAYOUT_RESOURCES' );
$html = ob_get_clean();
assert( strpos( $html, 'dark-mode.css' ) === false );
assert( strpos( $html, 'dark-mode-prefectura.css' ) === false );
assert( strpos( $html, 'toggle.css' ) !== false );

$_SERVER['REQUEST_URI'] = '/view_all_bug_page.php?foo=bar';
ob_start();
$plugin->render_toggle( 'EVENT_LAYOUT_PAGE_HEADER' );
$html = ob_get_clean();
assert( strpos( $html, 'value="dark"' ) !== false );
assert( strpos( $html, 'switch_to_dark' ) !== false );
assert( strpos( $html, 'view_all_bug_page.php?foo=bar' ) !== false );

$authenticated = false;
ob_start();
$plugin->render_toggle( 'EVENT_LAYOUT_PAGE_HEADER' );
assert( ob_get_clean() === '' );

echo "Smoke test passed\n";
