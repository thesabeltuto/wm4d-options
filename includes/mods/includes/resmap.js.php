<?php header('Content-type: text/javascript');
$wm4d_multiple_select = get_option('wm4d_multiple_select');
$wm4d_map_select = get_option('wm4d_map_select');
$wm4d_address = urlencode(trim(preg_replace('/\s\s+/', ', ', get_option('wm4d_location'))));
$wm4d_map_address = urlencode(trim(preg_replace('/\s\s+/', ', ', get_option('wm4d_map_address'))));
$wm4d_map_link = get_option('wm4d_map_link');

$wm4d_addresses = get_option('wm4d_locations');
$wm4d_map_addresses = get_option('wm4d_map_addresses');
$wm4d_map_links = get_option('wm4d_map_links');

for ( $i=0; $i < sizeof($wm4d_addresses); $i++ ) {
	$wm4d_addresses[$i] = urlencode(trim(preg_replace('/\s\s+/', ', ', $wm4d_addresses[$i])));
	$wm4d_map_addresses[$i] = urlencode(trim(preg_replace('/\s\s+/', ', ', $wm4d_map_addresses[$i])));
	$wm4d_map_links[$i] = $wm4d_map_links[$i];
}

$wm4d_addresses = json_encode($wm4d_addresses);
$wm4d_map_addresses = json_encode($wm4d_map_addresses);
$wm4d_map_links = json_encode($wm4d_map_links);
?>
if( '<?=$wm4d_map_select;?>' == 'enable' ) {
    jQuery(document).ready(function($) {
        jQuery("div.responsive-map div.gmap_marker").each().live('mouseenter',function(event) {
                var current_link = jQuery(this).children("strong").children("a").attr("href");
                var current_add = current_link.substr(30);
                //console.log( 'resmap currentlink '+current_link );
                
                if ( '<?=$wm4d_multiple_select?>' == 'enable' ) {
                    var themaplink = wm4d_resmap_multiple(current_add);
                } else {
                    var themaplink = wm4d_resmap_single(current_add);
                }
                   
                // CHANGE MAP LINK FINAL HERE
                jQuery(".gmap_marker strong a").attr("href",themaplink);
            //});
        });
    });
}

function wm4d_resmap_single(current_add) {
    var ad1 = '<?php echo $wm4d_address; ?>';
    var newad1 = '<?php echo $wm4d_map_address; ?>';
    var newlink1 = '<?php echo $wm4d_map_link; ?>';

    // DESICION MAKING AREA
        // SINGLE OPTION
        if( current_add == ad1 ) {
            if ( newad1 != '' && newlink1 != '' ){
                var themaplink = newlink1;
            }
            if ( newad1 != '' && newlink1 == '' ) {
                console.log( 'newad1 '+newad1);
                var themaplink = 'http://maps.google.com/?daddr='+newad1;
            }
            if (  newad1 == '' && newlink1 != '' ) {
                var themaplink = newlink1;
            }
        }
	return themaplink;
}

function wm4d_resmap_multiple(current_add) {
    var ad2 = <?php echo $wm4d_addresses; ?>;
    var newad2 = <?php echo $wm4d_map_addresses; ?>;
    var newlink2 = <?php echo $wm4d_map_links; ?>;

    // DESICION MAKING AREA
        // MULTIPLE OPTION    
            for ( var i=0; i < ad2.length; i++ ) {
                if( current_add == ad2[i] ) {
                    if ( newad2[i] != '' && newlink2[i] != '' ){
                        var themaplink = newlink2[i];
                    }
                    if ( newad2[i] != '' && newlink2[i] == '' ) {
                        var themaplink = 'http://maps.google.com/?daddr='+newad2[i];
                    }
                    if (  newad2[i] == '' && newlink2[i] != '' ) {
                        var themaplink = newlink2[i];
                    }
                }
            }
    return themaplink;
}