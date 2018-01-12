<?php
//	general theme settings
	include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/theme-functions.php');
	
<<<<<<< HEAD
//	plugin integration settings
	if( wp_get_theme( 'soulmedic' )->exists() ) {
	include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/plugins/layerslider.php');
	} else {
		add_filter( 'default_hidden_meta_boxes', 'enable_custom_fields_per_default', 20, 1 );	
	}
=======
//	soulmedic theme integration settings
	if( wp_get_theme() == 'soulmedic' ) {
		include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/plugins/layerslider.php');
		include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/themes/soulmedic.php');
	}

//	plugin integration settings
>>>>>>> refs/remotes/origin/master
	include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/plugins/responsive-map.php');
	include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/plugins/gravityforms.php');

?>