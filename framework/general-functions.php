<?php
/*** PLUGIN CHECKER ***/
function wm4d_is_plugin_active($plugin) {
	if (is_multisite ()) :
		$plugins = array ();
		$c_plugins = is_array ( get_site_option ( 'active_sitewide_plugins' ) ) ? get_site_option ( 'active_sitewide_plugins' ) : array ();
		foreach ( array_keys ( $c_plugins ) as $c_plugin ) :
			$plugins [] = $c_plugin;
		endforeach;
		return in_array ( $plugin, $plugins );
	 else :
		return in_array ( $plugin, ( array ) get_option ( 'active_plugins', array () ) );
	endif;
}

?>