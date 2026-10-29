<?php

auth_ensure_user_authenticated();
if( current_user_is_anonymous() ) {
	trigger_error( ERROR_ACCESS_DENIED, ERROR );
}

form_security_validate( 'plugin_MantisBTDarkMode_toggle' );

$t_mode = gpc_get_string( 'mode' );
if( !in_array( $t_mode, array( 'dark', 'light' ), true ) ) {
	trigger_error( ERROR_GENERIC, ERROR );
}

plugin_config_set( 'mode', $t_mode, auth_get_current_user_id(), ALL_PROJECTS, ANYBODY );
form_security_purge( 'plugin_MantisBTDarkMode_toggle' );

// Keep the user on the same MantisBT page without accepting an external URL.
$t_return = gpc_get_string( 'return_page', 'my_view_page.php' );
$t_parts = parse_url( $t_return );
$t_page = is_array( $t_parts ) && isset( $t_parts['path'] )
	? basename( $t_parts['path'] )
	: '';
if( !preg_match( '/^[a-zA-Z0-9_-]+\.php$/', $t_page ) ) {
	$t_page = 'my_view_page.php';
}
$t_query = is_array( $t_parts ) && isset( $t_parts['query'] ) ? $t_parts['query'] : '';
if( strlen( $t_query ) > 2048 || preg_match( '/[\x00-\x1F\x7F\\\\#]/', $t_query ) ) {
	$t_query = '';
}
print_header_redirect( $t_page . ( $t_query !== '' ? '?' . $t_query : '' ) );
