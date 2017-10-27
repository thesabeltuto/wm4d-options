<?php
//	general theme settings
	include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/theme-functions.php');
	
//	plugin integration settings
	if( wp_get_theme() == 'soulmedic' ) {
		include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/plugins/layerslider.php');
	} /*else {
		add_filter( 'default_hidden_meta_boxes', 'enable_custom_fields_per_default', 20, 1 );	
	}*/
	include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/plugins/responsive-map.php');
	include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/plugins/gravityforms.php');
	
//	theme integration settings
	include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/themes/soulmedic.php');



?>