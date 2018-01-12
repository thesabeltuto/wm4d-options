<?php
//	general theme settings
	include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/theme-functions.php');

	//	soulmedic theme integration settings
	if( wp_get_theme() == 'soulmedic' ) {
		include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/themes/soulmedic.php');
	}

//	plugin integration settings
	include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/plugins/layerslider.php');
	include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/plugins/responsive-map.php');
	include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/plugins/gravityforms.php');

?>