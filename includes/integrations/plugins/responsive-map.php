<?php
/* EDIT RESPONSIVE MAP SHORTCODE OUTPUT */
remove_shortcode('res_map');
//add_shortcode('res_map', 'responsive_map_shortcode_edited');
add_shortcode('res_map', 'responsive_map_shortcode_edited');
function responsive_map_shortcode_edited($atts) {

    // Extract the attributes from the shortcode
    $atts = shortcode_atts(array(
      'width'           => '100%',    // Use a width in 'px' or '%'. Default: 100%
      'height'          => '500px',   // Use a height in 'px' or '%'. Default: 500px
      'maptype'         => 'roadmap', // Possible values: roadmap, satellite, terrain or hybrid
      'zoom'            => 14,        // Zoom, use values between 1-19, default zoom=14
      'address'         => '',        // Markers list in this format: street, city, country | street, city, country | street, city, country
      'description'     => '',        // Markers descriptions in this format: description1 | description2 | description3 (one for each marker address above)
      'popup'           => 'no',      // 'yes' or 'no'
      'pancontrol'      => 'no',      // 'yes' or 'no'
      'zoomcontrol'     => 'no',      // 'yes' or 'no'
      'draggable'       => 'yes',     // 'yes' or 'no'
      'scrollwheel'     => 'no',      // 'yes' or 'no'
      'typecontrol'     => 'no',      // 'yes' or 'no'
      'scalecontrol'    => 'no',      // 'yes' or 'no'
      'streetcontrol'   => 'no',      // 'yes' or 'no'
      'searchbox'       => 'no',      // 'yes' or 'no'
      'clustering'      => 'no',      // 'yes' or 'no'
      'logging'         => 'no',      // 'yes' or 'no'
      'poi'             => 'yes',     // 'yes' or 'no'
      'directionstext'  => '',        // The text to be displayed for directions link
      'center'          => '',        // The point where the map should be centered (latitude, longitude) for instance: center="38.980288, 22.145996"
      'icon'            => 'green',   // Possible color values: black, blue, gray, green, magenta, orange, purple, red, white, yellow or a http link to a custom image
      'iconsize'        => '',        // Icon size
      'style'           => '1',       // Use style values between 1-50
      'refresh'         => 'no',      // 'yes' or 'no'
      'locateme'        => 'no',      // 'yes' or 'no'
      'fullscreen'      => 'no',      // 'yes' or 'no'
      'tabfix'          => 'no',      // 'yes' or 'no'
      'key'             => ''         // Google Maps API key

    ), $atts);

    // Enque jQuery
    wp_enqueue_script('jquery');

    // Save the Google Maps API key from the shortcode in the database
    $api_key = $atts['key'];

    if (isset($api_key)) {
        // Sanitize it
        $api_key = sanitize_text_field($api_key);
        // And save it in the database
        if ($api_key != "") {
            update_option('resmap_apikey', $api_key);
        }
    }

    // Enqueue Google Maps required scripts at the end of body, before of closing body tag (to prevent being overriden by other plugins)
    add_action('wp_footer', 'resmap_enqueue_scripts');

    // Generate a unique identifier for the map
    $mapid = rand();

    // Extract the map type
    $atts['maptype'] = strtoupper($atts['maptype']);

    // If width or height were specified in the shortcode, extract them too
    $dimensions = '';
    if (isset($atts['height'])) {
        $dimensions .= 'height:' . $atts['height'] . ';';
    }
    if (isset($atts['width'])) {
        $dimensions .= 'width:' . $atts['width'] . ';';
    }

    // Set the pre-defined style which corresponds to the number given in the shortcode
    $atts['style'] = getStyleString($atts['style']);

    // If points of interest (poi) is set to "no" in the shortcode, add this option to the style string
    // And this is the JSON for no points of interest: ', { "featureType": "poi", "stylers": [ { "visibility": "off" } ] }'
    $noPOI = ', {"featureType":"poi","stylers":[{"visibility": "off"}]}';
    if (isset($atts['poi']) && $atts['poi'] == 'no') {
        $atts['style'] = substr($atts['style'], 0, -1) . $noPOI . ']';
    }

    // Extract the langitude and longitude for the map center
    if (trim($atts['center'])  != "") {
        sscanf($atts['center'], '%f, %f', $lat, $long);
    } else {
        $lat = 'null';
        $long = 'null';
    }

    // Prepare markers list
    $markers = '[]';

    // Split the addresses, descriptions and icons (by the pipeline "|" delimiter)
    if ($atts['address'] != '') {
	/* -----------------------------------------------
	// - WM4D SHORTCODE EDIT - catch %% shortcodes
	// ----------------------------------------------- */
 		$att_address = $atts['address'];
		$att_address = call_addresses_shortcode($att_address);
		$att_description = $atts['description'];
		$att_description = call_description_shortcode($att_description);
		$att_icon = $atts['icon'];
		$att_icon = call_icons_shortcode($att_address, $att_icon);

//		console.log('$att_address '+$att_address);
//		console.log('$att_description '+$att_description);
//		console.log('$att_icon '+$att_icon);
		
        $addresses = explode("|", $att_address);
        $total_addresses = count($addresses);
        $descriptions = explode("|", $att_description);
        $icons = explode("|", $att_icon);

      // Start building the markers JSON array
        $markers = '[';

      // For each address from the list, build a marker (with popup with description and an icon)
        for ($i = 0; $i < $total_addresses; $i ++) {
            // Remove unneccessary line breaks from the addresses list
            $address = resmap_cleanHtml($addresses[$i]);

            $html = "<div id='resmap_popup'>";
            
            // If it's empty, set the default description equal to the the address
            if (isset($descriptions[$i]) && strlen(trim($descriptions[$i])) != 0) {
                $html .= $descriptions[$i];
            } else {
                $html .= $address;
            }
                
            // Add the directions link to the description
            if (isset($atts['directionstext']) && strlen(trim($atts['directionstext'])) != 0) {
                $directions = 'http://maps.google.com/?daddr=' . urlencode($address);
                $html .= "<br><strong><a target='_blank' href='". $directions ."'>". $atts['directionstext'] ."</a></strong>" ;
            }
                
            // Remove unneccessary line breaks from the $html and transforms {br} to <br>
            $html = resmap_cleanHtml($html);
            $html .= "</div>";
            
            // Get the correct icon image based on icon color/url which were given in the shortcode
            if (isset($icons[$i])) {
                $icon = resmap_getIcon($icons[$i]);
            }

            // Extract the lagitude and longitude
            $marker_latitude = null;
            $marker_longitude = null;
            if (trim($address)  != "") {
                sscanf($address, '%f, %f', $marker_latitude, $marker_longitude);
            }

            // See if we show popups.
            // If only one address, popup is true or false (what's given in the shortcode)
            // If more addresses and in shortcode popup is true, show the open popup only for first address.
            $popup = 'false';
            if (isset($atts['popup']) && $atts['popup'] == 'yes') {
                if ($total_addresses == 1) {
                    $popup = 'true';
                } elseif ($total_addresses >= 1) {
                    $i == 0 ? ($popup = 'true') : ($popup = 'false');
                }
            }

            // If more markers, add the neccessary "," delimiter between markers
            if ($i > 0) {
                $markers .= ",";
            }
            
            // Build markers list based on given address or latitude/longitude
            if ($marker_latitude == '' || $marker_longitude == '') {
                $markers .= "{
                        address: '" . $address . "', 
                        key: '". ($i + 1)  . "',";
            } else {
                $markers .= "{
                        latitude:" . $marker_latitude .", 
                        longitude:" . $marker_longitude .",
                        key: '" . ($i +1) . "',";
            }
              $markers .= "html:'" . $html . "',
                        popup: ". $popup . ",
                        flat: true,
                        icon: {
                            image: '". $icon . "'";
            if (trim($atts['iconsize'])  != "") {
                $markers .= ", iconsize: [" . $atts['iconsize'] . "]";
            }
              $markers .= "}}";
        }
        $markers .= ']';
    }
    // Tell PHP to start output buffering
    ob_start();
    ?><script type="text/javascript">
    jQuery(document).ready(function($) {
        // the div that will contain the map
        var mapdiv = jQuery("#responsive_map_<?php echo $mapid; ?>"); 
        // markers should be clustered?
        var clustering = "<?php echo $atts['clustering']; ?>"; 
        // Create the map in the div 
        mapdiv.gMapResp({
            maptype: google.maps.MapTypeId.<?php echo $atts['maptype']; ?>,
            log: <?php echo resmap_toBool($atts['logging']); ?>,
            zoom: <?php echo $atts['zoom']; ?>,
            markers: <?php echo $markers; ?>,
            panControl: <?php echo resmap_toBool($atts['pancontrol']); ?>,
            zoomControl: <?php echo resmap_toBool($atts['zoomcontrol']); ?>,
            draggable: <?php echo resmap_toBool($atts['draggable']); ?>,
            scrollwheel: <?php echo resmap_toBool($atts['scrollwheel']); ?>,
            mapTypeControl: <?php echo resmap_toBool($atts['typecontrol']); ?>,
            scaleControl: <?php echo resmap_toBool($atts['scalecontrol']); ?>,
            streetViewControl: <?php echo resmap_toBool($atts['streetcontrol']); ?>,
            overviewMapControl: true,
            fullscreenControl: <?php echo resmap_toBool($atts['fullscreen']); ?>,
            styles: <?php echo $atts['style']; ?>,
            latitude: <?php echo $lat; ?>,
            longitude: <?php echo $long; ?>,
            onComplete: function() {
                var gmap = mapdiv.data('gmap').gmap;
                if (clustering.length  != 0 && clustering == "yes") {
                    var markerCluster = new MarkerClusterer(gmap, mapdiv.data('gmap').markers, {imagePath: '<?php echo esc_url(plugins_url()); ?>/responsive-maps-plugin/includes/img/m'});
                }
            }
        });
        gmap = mapdiv.data('gmap').gmap;
    <?php if (isset($atts['searchbox']) && $atts['searchbox'] == 'yes') { ?>
    resmap_createSearchBox(gmap);
    <?php }
if (isset($atts['locateme']) && $atts['locateme'] == 'yes') { ?>
    resmap_addLocatemeButton(gmap);
<?php }
if (isset($atts['tabfix']) && $atts['tabfix'] == 'yes') { ?>
    resmap_fixDisplayInTabs(mapdiv);
<?php } ?>
    });
    <?php if (isset($atts['refresh']) && $atts['refresh'] == 'yes') { ?>
    window.onresize = function() {
        jQuery('.responsive-map').each(function(i, obj) {
            jQuery(this).gMapResp('fixAfterResize');
        });
    };
    <?php } ?>
  </script>
    <div id="responsive_map_<?php echo $mapid; ?>" class="responsive-map" style="<?php echo $dimensions; ?>"></div><?php return ob_get_clean();
} ?>