<?php
// HOME NAVIGATION
function WM4D_OPTIONS_PLUGIN_home_navigation() {
	$param_page = $_GET['page'];
	
	switch ($param_page) {
		case 'wm4d_options':
		?>
            <li><a href="?page=wm4d_options">Home</a></li>
            <li><a href="?page=wm4d_options_client_options">Client Options</a></li>
            <li><a href="?page=wm4d_options_flipper_options">Flipper Options</a></li>
            <li><a href="?page=wm4d_options_custom_codes">Custom Codes</a></li>
            <li><a href="?page=wm4d_options_page_options">Page Texts</a></li>
            <li><a href="?page=wm4d_mods">Mods</a></li>
            <li><a href="?page=wm4d_options_support">Support</a></li>
            <li><a href="?page=wm4d_options_about">About</a></li>
            <?php
			WM4D_OPTIONS_PLUGIN_navigation_BETA_ENABLED();
		break;
	}
}

function WM4D_OPTIONS_PLUGIN_home_navigation_BETA_ENABLED(){
	if(get_option('wm4d_beta_select') == 'enable') {
	?>
		<li><a href="?page=wm4d_options_beta_test">Beta Test*</a></li>
	<?php
	}
}
function WM4D_OPTIONS_PLUGIN_navigation_BETA_ENABLED(){
	if(get_option('wm4d_beta_select') == 'enable') {
	?>
		<li id="wm4d_li7"><a href="?page=wm4d_options_beta_test">Beta Test*</a></li>
	<?php
	}
}

// HEADER NAVIGATION
function WM4D_OPTIONS_PLUGIN_navigation() {
	$param_page = $_GET['page'];
	
	switch ($param_page) {
		case 'wm4d_options':
		?>
            <li id="wm4d_li0" class="active"><a href="?page=wm4d_options">Home</a></li>
            <li id="wm4d_li5"><a href="?page=wm4d_options_client_options">Client Options</a></li>
            <li id="wm4d_li6"><a href="?page=wm4d_options_flipper_options">Flipper Options</a></li>
            <li id="wm4d_li1"><a href="?page=wm4d_options_custom_codes">Custom Codes</a></li>
            <li id="wm4d_li2"><a href="?page=wm4d_options_page_options">Page Options</a></li>
            <li id="wm4d_li8"><a href="?page=wm4d_mods">Mods</a></li>
            <li id="wm4d_li3"><a href="?page=wm4d_options_support">Support</a></li>
            <li id="wm4d_li4"><a href="?page=wm4d_options_about">About</a></li>
            <?php
			WM4D_OPTIONS_PLUGIN_navigation_BETA_ENABLED();
            break;
		case 'wm4d_options_client_options':
		?>
            <li id="wm4d_li0"><a href="?page=wm4d_options">Home</a></li>
            <li id="wm4d_li5" class="active"><a href="?page=wm4d_options_client_options">Client Options</a></li>
            <li id="wm4d_li6"><a href="?page=wm4d_options_flipper_options">Flipper Options</a></li>
            <li id="wm4d_li1"><a href="?page=wm4d_options_custom_codes">Custom Codes</a></li>
            <li id="wm4d_li2"><a href="?page=wm4d_options_page_options">Page Options</a></li>
            <li id="wm4d_li8"><a href="?page=wm4d_mods">Mods</a></li>
            <li id="wm4d_li3"><a href="?page=wm4d_options_support">Support</a></li>
            <li id="wm4d_li4"><a href="?page=wm4d_options_about">About</a></li>
            <?php
			WM4D_OPTIONS_PLUGIN_navigation_BETA_ENABLED();
            break;
		case 'wm4d_options_flipper_options':
		?>
            <li id="wm4d_li0"><a href="?page=wm4d_options">Home</a></li>
            <li id="wm4d_li5"><a href="?page=wm4d_options_client_options">Client Options</a></li>
            <li id="wm4d_li6" class="active"><a href="?page=wm4d_options_flipper_options">Flipper Options</a></li>
            <li id="wm4d_li1"><a href="?page=wm4d_options_custom_codes">Custom Codes</a></li>
            <li id="wm4d_li2"><a href="?page=wm4d_options_page_options">Page Options</a></li>
            <li id="wm4d_li8"><a href="?page=wm4d_mods">Mods</a></li>
            <li id="wm4d_li3"><a href="?page=wm4d_options_support">Support</a></li>
            <li id="wm4d_li4"><a href="?page=wm4d_options_about">About</a></li>
            <?php
			WM4D_OPTIONS_PLUGIN_navigation_BETA_ENABLED();
            break;
		case 'wm4d_options_custom_codes':
		?>
            <li id="wm4d_li0"><a href="?page=wm4d_options">Home</a></li>
            <li id="wm4d_li5"><a href="?page=wm4d_options_client_options">Client Options</a></li>
            <li id="wm4d_li6"><a href="?page=wm4d_options_flipper_options">Flipper Options</a></li>
            <li id="wm4d_li1" class="active"><a href="?page=wm4d_options_custom_codes">Custom Codes</a></li>
            <li id="wm4d_li2"><a href="?page=wm4d_options_page_options">Page Options</a></li>
            <li id="wm4d_li8"><a href="?page=wm4d_mods">Mods</a></li>
            <li id="wm4d_li3"><a href="?page=wm4d_options_support">Support</a></li>
            <li id="wm4d_li4"><a href="?page=wm4d_options_about">About</a></li>
            <?php
			WM4D_OPTIONS_PLUGIN_navigation_BETA_ENABLED();
            break;
		case 'wm4d_options_page_options':
		?>
            <li id="wm4d_li0"><a href="?page=wm4d_options">Home</a></li>
            <li id="wm4d_li5"><a href="?page=wm4d_options_client_options">Client Options</a></li>
            <li id="wm4d_li6"><a href="?page=wm4d_options_flipper_options">Flipper Options</a></li>
            <li id="wm4d_li1"><a href="?page=wm4d_options_custom_codes">Custom Codes</a></li>
            <li id="wm4d_li2" class="active"><a href="?page=wm4d_options_page_options">Page Options</a></li>
            <li id="wm4d_li8"><a href="?page=wm4d_mods">Mods</a></li>
            <li id="wm4d_li3"><a href="?page=wm4d_options_support">Support</a></li>
            <li id="wm4d_li4"><a href="?page=wm4d_options_about">About</a></li>
            <?php
			WM4D_OPTIONS_PLUGIN_navigation_BETA_ENABLED();
            break;
		case 'wm4d_options_support':
		?>
            <li id="wm4d_li0"><a href="?page=wm4d_options">Home</a></li>
            <li id="wm4d_li5"><a href="?page=wm4d_options_client_options">Client Options</a></li>
            <li id="wm4d_li6"><a href="?page=wm4d_options_flipper_options">Flipper Options</a></li>
            <li id="wm4d_li1"><a href="?page=wm4d_options_custom_codes">Custom Codes</a></li>
            <li id="wm4d_li2"><a href="?page=wm4d_options_page_options">Page Options</a></li>
            <li id="wm4d_li8"><a href="?page=wm4d_mods">Mods</a></li>
            <li id="wm4d_li3" class="active"><a href="?page=wm4d_options_support">Support</a></li>
            <li id="wm4d_li4"><a href="?page=wm4d_options_about">About</a></li>
            <?php
			WM4D_OPTIONS_PLUGIN_navigation_BETA_ENABLED();
            break;
		case 'wm4d_options_about':
		?>
            <li id="wm4d_li0"><a href="?page=wm4d_options">Home</a></li>
            <li id="wm4d_li5"><a href="?page=wm4d_options_client_options">Client Options</a></li>
            <li id="wm4d_li6"><a href="?page=wm4d_options_flipper_options">Flipper Options</a></li>
            <li id="wm4d_li1"><a href="?page=wm4d_options_custom_codes">Custom Codes</a></li>
            <li id="wm4d_li2"><a href="?page=wm4d_options_page_options">Page Options</a></li>
            <li id="wm4d_li8"><a href="?page=wm4d_mods">Mods</a></li>
            <li id="wm4d_li3"><a href="?page=wm4d_options_support">Support</a></li>
            <li id="wm4d_li4" class="active"><a href="?page=wm4d_options_about">About</a></li>
            <?php
			WM4D_OPTIONS_PLUGIN_navigation_BETA_ENABLED();
            break;
		case 'wm4d_options_beta_test':
		?>
            <li id="wm4d_li0"><a href="?page=wm4d_options">Home</a></li>
            <li id="wm4d_li5"><a href="?page=wm4d_options_client_options">Client Options</a></li>
            <li id="wm4d_li6"><a href="?page=wm4d_options_flipper_options">Flipper Options</a></li>
            <li id="wm4d_li1"><a href="?page=wm4d_options_custom_codes">Custom Codes</a></li>
            <li id="wm4d_li2"><a href="?page=wm4d_options_page_options">Page Options</a></li>
            <li id="wm4d_li8"><a href="?page=wm4d_mods">Mods</a></li>
            <li id="wm4d_li3"><a href="?page=wm4d_options_support">Support</a></li>
            <li id="wm4d_li4"><a href="?page=wm4d_options_about">About</a></li>
            <li id="wm4d_li7" class="active"><a href="?page=wm4d_options_beta_test">Beta Test*</a></li>
            <?php
            break;
	}
}

?>