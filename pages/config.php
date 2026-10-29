<?php

auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

$t_selected = plugin_config_get( 'palette', 'prefectura' );
if( !in_array( $t_selected, MantisBTDarkModePlugin::palettes(), true ) ) {
	$t_selected = 'prefectura';
}

layout_page_header( plugin_lang_get( 'title' ) );
layout_page_begin( 'manage_overview_page.php' );
print_manage_menu( 'manage_plugin_page.php' );
?>
<div class="col-md-12 col-xs-12">
	<div class="space-10"></div>
	<div class="form-container">
		<form action="<?php echo plugin_page( 'config_edit' ); ?>" method="post">
			<?php echo form_security_field( 'plugin_MantisBTDarkMode_config_edit' ); ?>
			<div class="widget-box widget-color-blue2">
				<div class="widget-header widget-header-small">
					<h4 class="widget-title lighter"><?php echo plugin_lang_get( 'title' ); ?></h4>
				</div>
				<div class="widget-body">
					<div class="widget-main no-padding">
						<table class="table table-bordered table-condensed">
							<tr>
								<th class="category"><label for="dark-mode-palette"><?php echo plugin_lang_get( 'palette' ); ?></label></th>
								<td>
									<select id="dark-mode-palette" name="palette" class="form-control">
										<?php foreach( MantisBTDarkModePlugin::palettes() as $t_palette ) { ?>
											<option value="<?php echo $t_palette; ?>"<?php echo $t_selected === $t_palette ? ' selected="selected"' : ''; ?>><?php echo plugin_lang_get( 'palette_' . $t_palette ); ?></option>
										<?php } ?>
									</select>
									<p class="help-block"><?php echo plugin_lang_get( 'palette_help' ); ?></p>
								</td>
							</tr>
						</table>
					</div>
					<div class="widget-toolbox padding-8 clearfix">
						<button type="submit" class="btn btn-primary"><?php echo lang_get( 'change_configuration' ); ?></button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<?php layout_page_end(); ?>
