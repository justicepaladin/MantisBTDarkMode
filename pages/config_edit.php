<?php

form_security_validate( 'plugin_MantisBTDarkMode_config_edit' );
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

$t_palette = gpc_get_string( 'palette' );
if( !in_array( $t_palette, MantisBTDarkModePlugin::palettes(), true ) ) {
	trigger_error( ERROR_GENERIC, ERROR );
}

plugin_config_set( 'palette', $t_palette );
form_security_purge( 'plugin_MantisBTDarkMode_config_edit' );
print_successful_redirect( plugin_page( 'config', true ) );
