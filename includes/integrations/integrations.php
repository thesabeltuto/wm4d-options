<?php
//	general theme settings
	include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/theme-functions.php');
	
//	theme integration settings
	include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/themes/soulmedic.php'); //soulmedic content tags
	
//	theme matches soulmedic name	
	if( preg_match( '/soulmedic/', wp_get_theme() ) == true )  {
		include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/plugins/layerslider.php'); //soulmedic specific metabox
	}
	
//	plugin integration settings
	include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/plugins/responsive-map.php');
	include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/plugins/gravityforms.php');	
?>