<?php

/**
 * Dark palettes for MantisBT 2.28.4.
 */
class MantisBTDarkModePlugin extends MantisPlugin {
	public function register() {
		$this->name = plugin_lang_get( 'title' );
		$this->description = plugin_lang_get( 'description' );
		$this->page = 'config';
		$this->version = '0.1.0';
		$this->requires = array( 'MantisCore' => '2.28.4' );
		$this->author = 'Facundo Martín Mayordomo';
		$this->contact = 'https://fmayordomo.com.ar';
		$this->url = 'https://fmayordomo.com.ar';
	}

	public function config() {
		return array( 'palette' => 'prefectura' );
	}

	public function hooks() {
		return array( 'EVENT_LAYOUT_RESOURCES' => 'add_css' );
	}

	public static function palettes() {
		return array( 'prefectura', 'grafito', 'oceano', 'arena' );
	}

	public function add_css( $p_event ) {
		$t_palette = plugin_config_get( 'palette', 'prefectura' );
		if( !in_array( $t_palette, self::palettes(), true ) ) {
			$t_palette = 'prefectura';
		}

		foreach( array( 'dark-mode-' . $t_palette . '.css', 'dark-mode.css' ) as $t_file ) {
			$t_url = htmlspecialchars( plugin_file( $t_file ), ENT_QUOTES, 'UTF-8' );
			echo '<link rel="stylesheet" href="' . $t_url . '" />' . "\n";
		}
	}
}
