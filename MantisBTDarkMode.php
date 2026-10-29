<?php

/**
 * Dark palettes for MantisBT 2.28.4.
 */
class MantisBTDarkModePlugin extends MantisPlugin {
	public function register() {
		$this->name = plugin_lang_get( 'title' );
		$this->description = plugin_lang_get( 'description' );
		$this->page = 'config';
		$this->version = '0.2.0';
		$this->requires = array( 'MantisCore' => '2.28.4' );
		$this->author = 'Facundo Martín Mayordomo';
		$this->contact = 'https://fmayordomo.com.ar';
		$this->url = 'https://fmayordomo.com.ar';
	}

	public function config() {
		return array(
			'palette' => 'prefectura',
			'mode' => 'dark',
		);
	}

	public function hooks() {
		return array(
			'EVENT_LAYOUT_RESOURCES' => 'add_css',
			'EVENT_LAYOUT_PAGE_HEADER' => 'render_toggle',
		);
	}

	public static function palettes() {
		return array( 'prefectura', 'grafito', 'oceano', 'arena' );
	}

	public function current_mode() {
		if( !auth_is_user_authenticated() || current_user_is_anonymous() ) {
			return 'dark';
		}

		$t_mode = plugin_config_get( 'mode', 'dark', false, auth_get_current_user_id(), ALL_PROJECTS );
		return in_array( $t_mode, array( 'dark', 'light' ), true ) ? $t_mode : 'dark';
	}

	public function add_css( $p_event ) {
		if( $this->current_mode() === 'dark' ) {
			$t_palette = plugin_config_get( 'palette', 'prefectura' );
			if( !in_array( $t_palette, self::palettes(), true ) ) {
				$t_palette = 'prefectura';
			}

			foreach( array( 'dark-mode-' . $t_palette . '.css', 'dark-mode.css' ) as $t_file ) {
				$t_url = htmlspecialchars( plugin_file( $t_file ), ENT_QUOTES, 'UTF-8' );
				echo '<link rel="stylesheet" href="' . $t_url . '" />' . "\n";
			}
		}

		$t_toggle_css = htmlspecialchars( plugin_file( 'toggle.css' ), ENT_QUOTES, 'UTF-8' );
		$t_toggle_js = htmlspecialchars( plugin_file( 'toggle.js' ), ENT_QUOTES, 'UTF-8' );
		echo '<link rel="stylesheet" href="' . $t_toggle_css . '" />' . "\n";
		echo '<script src="' . $t_toggle_js . '"></script>' . "\n";
	}

	public function render_toggle( $p_event ) {
		if( !auth_is_user_authenticated() || current_user_is_anonymous() ) {
			return;
		}

		$t_dark = $this->current_mode() === 'dark';
		$t_next = $t_dark ? 'light' : 'dark';
		$t_label = plugin_lang_get( $t_dark ? 'switch_to_light' : 'switch_to_dark' );
		$t_label = htmlspecialchars( $t_label, ENT_QUOTES, 'UTF-8' );
		$t_action = htmlspecialchars( plugin_page( 'toggle' ), ENT_QUOTES, 'UTF-8' );
		$t_return = htmlspecialchars( $_SERVER['REQUEST_URI'] ?? 'my_view_page.php', ENT_QUOTES, 'UTF-8' );
		$t_icon = $t_dark ? 'fa-sun-o' : 'fa-moon-o';

		echo '<div id="mantisbt-darkmode-toggle" class="mantisbt-darkmode-toggle">';
		echo '<form action="' . $t_action . '" method="post">';
		echo form_security_field( 'plugin_MantisBTDarkMode_toggle' );
		echo '<input type="hidden" name="mode" value="' . $t_next . '">';
		echo '<input type="hidden" name="return_page" value="' . $t_return . '">';
		echo '<button type="submit" class="mantisbt-darkmode-button" aria-label="' . $t_label . '">';
		echo '<i class="ace-icon fa ' . $t_icon . '" aria-hidden="true"></i> ' . $t_label;
		echo '</button></form></div>' . "\n";
	}
}
