<?php 
/** MAKE SHORTCODES WORK ON WIDGET **/
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

/** MAKE THUMBNAILS WORK ON CUSTOM POSTS **/
add_action( 'after_setup_theme', 'wm4d_theme_additionals', 99 );
function wm4d_theme_additionals() {
	add_theme_support( 'post-thumbnails', array( 'procedures', 'offers', 'before-and-afters', 'office-images', 'testimonials' ) );
}

/** PROCEDURE CUSTOM TYPE **/
add_action( 'init', 'custom_post_procedures' );
function custom_post_procedures() {
	$labels = array(
		'name'               => _x( 'Procedures', 'post type general name' ),
		'singular_name'      => _x( 'Procedure', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'procedure' ),
		'add_new_item'       => __( 'Add New Procedure' ),
		'edit_item'          => __( 'Edit Procedure' ),
		'new_item'           => __( 'New Procedure' ),
		'all_items'          => __( 'All Procedures' ),
		'view_item'          => __( 'View Procedure' ),
		'search_items'       => __( 'Search Procedures' ),
		'not_found'          => __( 'No procedures found' ),
		'not_found_in_trash' => __( 'No procedures found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Procedures'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our procedures and procedure specific data',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'post-formats' ),
		'has_archive'   => true
	);
	register_post_type( 'procedures', $args );	
}

add_filter( 'post_updated_messages', 'custom_post_procedure_messages' );
function custom_post_procedure_messages( $messages ) {
	global $post, $post_ID;
	$messages['procedures'] = array(
		0 => '', 
		1 => sprintf( __('Procedure updated. <a href="%s">View procedure</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Procedure updated.'),
		5 => isset($_GET['revision']) ? sprintf( __('Procedure restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Procedure published. <a href="%s">View procedure</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Procedure saved.'),
		8 => sprintf( __('Procedure submitted. <a target="_blank" href="%s">Preview procedure</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Procedure scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview procedure</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Procedure draft updated. <a target="_blank" href="%s">Preview procedure</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
}

add_filter('body_class','gsdental_body_classes',20);
function gsdental_body_classes( $classes ) {

	if( is_singular( 'procedures' ) ) {
		foreach($classes as $key => $value) {
		if ($value == 'full-width') unset($classes[$key]);
      }
	}
	if( is_archive( 'office-images' ) || is_archive( 'testimonials' ) || is_archive( 'before-and-afters' ) ) {
		$classes[] = 'full-width';
	}
	return $classes;
}

/** OFFERS CUSTOM TYPE **/
add_action( 'init', 'custom_post_offers' );
function custom_post_offers() {
	$labels = array(
		'name'               => _x( 'Offers', 'post type general name' ),
		'singular_name'      => _x( 'Offer', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'offer' ),
		'add_new_item'       => __( 'Add New Offer' ),
		'edit_item'          => __( 'Edit Offer' ),
		'new_item'           => __( 'New Offer' ),
		'all_items'          => __( 'All Offers' ),
		'view_item'          => __( 'View Offer' ),
		'search_items'       => __( 'Search Offers' ),
		'not_found'          => __( 'No offers found' ),
		'not_found_in_trash' => __( 'No offers found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Offers'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our offers and offer specific data',
		'public'        => true,
		'menu_position' => 6,
		'supports'      => array( 'title', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
	);
	register_post_type( 'offers', $args );	
}

add_filter( 'post_updated_messages', 'custom_post_offer_messages' );
function custom_post_offer_messages( $messages ) {
	global $post, $post_ID;
	$messages['offers'] = array(
		0 => '', 
		1 => sprintf( __('Offer updated. <a href="%s">View offer</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Offer updated.'),
		5 => isset($_GET['revision']) ? sprintf( __('Offer restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Offer published. <a href="%s">View offer</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Offer saved.'),
		8 => sprintf( __('Offer submitted. <a target="_blank" href="%s">Preview offer</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Offer scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview offer</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Offer draft updated. <a target="_blank" href="%s">Preview offer</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
}

add_action( 'init', 'gsdental_taxonomies_offers', 0 );
function gsdental_taxonomies_offers() {
	$labels = array(
		'name'              => _x( 'Procedure Tags', 'taxonomy general name' ),
		'singular_name'     => _x( 'Procedure Tag', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Procedure Tags' ),
		'all_items'         => __( 'All Procedure Tags' ),
		'parent_item'       => __( 'Parent Procedure Tag' ),
		'parent_item_colon' => __( 'Parent Procedure Tag:' ),
		'edit_item'         => __( 'Edit Procedure Tag' ), 
		'update_item'       => __( 'Update Procedure Tag' ),
		'add_new_item'      => __( 'Add New Procedure Tag' ),
		'new_item_name'     => __( 'New Procedure Tag' ),
		'menu_name'         => __( 'Procedure Tags' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'procedure_tags', 'offers', $args );
}

/** TESTIMONIALS CUSTOM TYPE **/
add_action( 'init', 'custom_post_testimonials' );
function custom_post_testimonials() {
	$labels = array(
		'name'               => _x( 'Testimonials', 'post type general name' ),
		'singular_name'      => _x( 'Testimonial', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'testimonials' ),
		'add_new_item'       => __( 'Add New Testimonial' ),
		'edit_item'          => __( 'Edit Testimonial' ),
		'new_item'           => __( 'New Testimonial' ),
		'all_items'          => __( 'All Testimonials' ),
		'view_item'          => __( 'View Testimonial' ),
		'search_items'       => __( 'Search Testimonials' ),
		'not_found'          => __( 'No testimonials found' ),
		'not_found_in_trash' => __( 'No testimonials found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Testimonials'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our testimonials and testimonial specific data',
		'public'        => true,
		'menu_position' => 7,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
	);
	register_post_type( 'testimonials', $args );	
}

add_filter( 'post_updated_messages', 'custom_post_testimonial_messages' );
function custom_post_testimonial_messages( $messages ) {
	global $post, $post_ID;
	$messages['testimonials'] = array(
		0 => '', 
		1 => sprintf( __('Testimonial updated. <a href="%s">View Testimonial</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Testimonial updated.'),
		5 => isset($_GET['revision']) ? sprintf( __('Testimonial restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Testimonial published. <a href="%s">View testimonial</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Testimonial saved.'),
		8 => sprintf( __('Testimonial submitted. <a target="_blank" href="%s">Preview testimonial</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Testimonial scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview testimonial</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Testimonial draft updated. <a target="_blank" href="%s">Preview testimonial</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
}

add_action( 'init', 'gsdental_taxonomies_testimonials', 0 );
function gsdental_taxonomies_testimonials() {
	$labels = array(
		'name'              => _x( 'Testimonial Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Testimonial Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Testimonial Categories' ),
		'all_items'         => __( 'All Testimonial Categories' ),
		'parent_item'       => __( 'Parent Testimonial Category' ),
		'parent_item_colon' => __( 'Parent Testimonial Category:' ),
		'edit_item'         => __( 'Edit Testimonial Category' ), 
		'update_item'       => __( 'Update Testimonial Category' ),
		'add_new_item'      => __( 'Add New Testimonial Category' ),
		'new_item_name'     => __( 'New Testimonial Category' ),
		'menu_name'         => __( 'Testimonial Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'testimonial_categories', 'testimonials', $args );
}

/** BEFORE & AFTERS CUSTOM POST **/
add_action( 'init', 'custom_post_before_and_afters' );
function custom_post_before_and_afters() {
	$labels = array(
		'name'               => _x( 'Before & Afters', 'post type general name' ),
		'singular_name'      => _x( 'Before & Afters', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'before_afters' ),
		'add_new_item'       => __( 'Add New Before & Afters' ),
		'edit_item'          => __( 'Edit Before & Afters' ),
		'new_item'           => __( 'New Before & Afters' ),
		'all_items'          => __( 'All Before & Afters' ),
		'view_item'          => __( 'View Before & Afters' ),
		'search_items'       => __( 'Search Before & Afters' ),
		'not_found'          => __( 'No Before & Afters found' ),
		'not_found_in_trash' => __( 'No Before & Afters found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Before & Afters'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our Before & Afters specific data',
		'public'        => true,
		'menu_position' => 8,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'images' ),
		'has_archive'   => true,
	);
	register_post_type( 'before-and-afters', $args );	
}

add_filter( 'post_updated_messages', 'custom_post_before_and_afters_messages' );
function custom_post_before_and_afters_messages( $messages ) {
	global $post, $post_ID;
	$messages['before-and-afters'] = array(
		0 => '', 
		1 => sprintf( __('Before & Afters updated. <a href="%s">View Before & Afters</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Before & Afters updated.'),
		5 => isset($_GET['revision']) ? sprintf( __('Before & Afters restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Before & Afters published. <a href="%s">View Before & Afters</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Before & Afters saved.'),
		8 => sprintf( __('Before & Afters submitted. <a target="_blank" href="%s">Preview Before & Afters</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Before & Afters scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Before & Afters</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Before & Afters draft updated. <a target="_blank" href="%s">Preview Before & Afters</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
}

/** OFFICE IMAGES CUSTOM TYPE **/
add_action( 'init', 'custom_post_office_images' );
function custom_post_office_images() {
	$labels = array(
		'name'               => _x( 'Office Images', 'post type general name' ),
		'singular_name'      => _x( 'Office Image', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'office_images' ),
		'add_new_item'       => __( 'Add New Office Image' ),
		'edit_item'          => __( 'Edit Office Image' ),
		'new_item'           => __( 'New Office Image' ),
		'all_items'          => __( 'All Office Images' ),
		'view_item'          => __( 'View Office Image' ),
		'search_items'       => __( 'Search Office Images' ),
		'not_found'          => __( 'No Office Images found' ),
		'not_found_in_trash' => __( 'No Office Images found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Office Images'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our office images and office images specific data',
		'public'        => true,
		'menu_position' => 9,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'post-formats' ),
		'has_archive'   => true,
	);
	register_post_type( 'office-images', $args );	
}

add_filter( 'post_updated_messages', 'custom_post_office_images_msg' );
function custom_post_office_images_msg( $messages ) {
	global $post, $post_ID;
	$messages['office-images'] = array(
		0 => '', 
		1 => sprintf( __('Office Image updated. <a href="%s">View Office Image</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Office Image updated.'),
		5 => isset($_GET['revision']) ? sprintf( __('Office Image restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Office Image published. <a href="%s">View Office Image</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Office Image saved.'),
		8 => sprintf( __('Office Image submitted. <a target="_blank" href="%s">Preview Office Image</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Office Image scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Office Image</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Office Image draft updated. <a target="_blank" href="%s">Preview Office Image</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
}

/** Special Offer Widget **/
add_action( 'widgets_init', create_function( '', 'register_widget("gsthirteen_special_offer");'));
class gsthirteen_special_offer extends WP_Widget {
	function gsthirteen_special_offer() {
		$widget_options = array(
		'classname' => 'gsdental_offer',
		'description' => 'Special Offer Options' );
		parent::WP_Widget("gsdental_offer", "Special Offer", $widget_options);
	}
 
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'price' => '', 'service_offer' => '', 'options_list' => '', 'tagline' => '', 'consult_btn' => '', 'extend_offer' => '', 'gform_consult_id' => '', 'gform_extend_id' => '', 'gform_consult_url' => '', 'gform_extend_url' => '') );
		$title = $instance['title'];
		$price = $instance['price'];
		$service_offer = $instance['service_offer'];
		$options_list = $instance['options_list'];
		$tagline = $instance['tagline'];
		$consult_btn = $instance['consult_btn'];
		$extend_offer = $instance['extend_offer'];
		$gform_consult_id = $instance['gform_consult_id'];
		$gform_extend_id = $instance['gform_extend_id'];
		$gform_consult_url = $instance['gform_consult_url'];
		$gform_extend_url = $instance['gform_extend_url'];
	  ?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo   $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title ?>"   />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('price'); ?>">Price Text:</label>
		<input id="<?php echo $this->get_field_id( 'price' ); ?>" name="<?php   echo $this->get_field_name( 'price' ); ?>" type="text" value="<?php echo   $price ?>"/>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('service_offer'); ?>">Type of Service:</label>
		<input id="<?php echo $this->get_field_id( 'service_offer' ); ?>" name="<?php echo  $this->get_field_name( 'service_offer' ); ?>" type="text" value="<?php echo $service_offer ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('options_list'); ?>">Service Options:</label>
		<textarea id="<?php echo $this->get_field_id( 'options_list' ); ?>" name="<?php echo  $this->get_field_name( 'options_list' ); ?>" type="text" value="<?php echo $options_list ?>"><?php echo $options_list; ?></textarea>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('tagline'); ?>">Tagline:</label>
		<input id="<?php echo $this->get_field_id( 'tagline' ); ?>" name="<?php echo  $this->get_field_name( 'tagline' ); ?>" type="text" value="<?php echo $tagline ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('consult_btn'); ?>">Consult Button Label:</label>
		<input id="<?php echo $this->get_field_id( 'consult_btn' ); ?>" name="<?php echo  $this->get_field_name( 'consult_btn' ); ?>" type="text" value="<?php echo $consult_btn ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('gform_consult_id'); ?>">Consult Offer Gravity Forms ID:</label>
		<input id="<?php echo $this->get_field_id( 'gform_consult_id' ); ?>" name="<?php echo  $this->get_field_name( 'gform_consult_id' ); ?>" type="text" value="<?php echo $gform_consult_id ?>" />
		</p> 
		<p>
		<label for="<?php echo $this->get_field_id('gform_consult_url'); ?>">Consult Offer Page URL:</label>
		<input id="<?php echo $this->get_field_id( 'gform_consult_url' ); ?>" name="<?php echo  $this->get_field_name( 'gform_consult_url' ); ?>" type="text" value="<?php echo $gform_consult_url ?>" />
		</p> 

		<p>
		<label for="<?php echo $this->get_field_id('extend_offer'); ?>">Extend Offer Label:</label>
		<input id="<?php echo $this->get_field_id( 'extend_offer' ); ?>" name="<?php echo  $this->get_field_name( 'extend_offer' ); ?>" type="text" value="<?php echo $extend_offer ?>" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id('gform_extend_id'); ?>">Extend Offer Gravity Forms ID:</label>
		<input id="<?php echo $this->get_field_id( 'gform_extend_id' ); ?>" name="<?php echo  $this->get_field_name( 'gform_extend_id' ); ?>" type="text" value="<?php echo $gform_extend_id ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('gform_extend_url'); ?>">Extend Offer Page URL:</label>
		<input id="<?php echo $this->get_field_id( 'gform_extend_url' ); ?>" name="<?php echo  $this->get_field_name( 'gform_extend_url' ); ?>" type="text" value="<?php echo $gform_extend_url ?>" />
		</p>
		<?php
	}
 
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = $new_instance['title'];
		$instance['price'] = $new_instance['price'];
		$instance['service_offer'] = $new_instance['service_offer'];
		$instance['options_list'] = $new_instance['options_list'];
		$instance['tagline'] = $new_instance['tagline'];
		$instance['consult_btn'] = $new_instance['consult_btn'];
		$instance['extend_offer'] = $new_instance['extend_offer'];
		$instance['gform_consult_id'] = $new_instance['gform_consult_id'];
		$instance['gform_extend_id'] = $new_instance['gform_extend_id'];
		$instance['gform_consult_url'] = $new_instance['gform_consult_url'];
		$instance['gform_extend_url'] = $new_instance['gform_extend_url'];
		return $instance;
	}
 
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$price = apply_filters( 'widget_price', $instance['price'] );
		$service_offer = apply_filters( 'widget_service_offer', $instance['service_offer'] );
		$options_list = apply_filters( 'widget_options_list', $instance['options_list'] );
		$tagline = apply_filters( 'widget_tagline', $instance['tagline']  );
		$consult_btn = apply_filters( 'widget_consult_btn', $instance['consult_btn']  );
		$extend_offer = apply_filters( 'widget_extend_offer', $instance['extend_offer']  );
		$gform_consult_id = apply_filters('widget_gform_consult_id', $instance['gform_consult_id']);
		$gform_extend_id = apply_filters('widget_gform_extend_id', $instance['gform_extend_id']);
		$gform_consult_url = apply_filters('widget_gform_consult_url', $instance['gform_consult_url']);
		$gform_extend_url = apply_filters('widget_gform_extend_url', $instance['gform_extend_url']);
		$offer_expires_date = date("Y-m-d");
	
		echo $before_widget; 
		echo '<div id="offer-heading">'.$title.'</div>';
		echo '<div id="offer-wrap"><div id="offer"><h2>' . $price . '</h2>';
		echo '<span>' . $service_offer . '</span></div>';
		echo '<div id="offer-details"><div id="offer-features">' . $options_list . '</div></div>';
		echo '<div id="tagline">'. $tagline . '</div>'; /*OpenInNewTab();*/
		echo '<div id="consult-btn-text"><div class="various" href="#gform-consult-form-'. $gform_consult_id . '"><a href="' . $gform_consult_url . '" target="_blank">' . $consult_btn . '</a></div></div>';
		echo '<div id="expire-offer">Offer expires: ' . $offer_expires_date . '</div>';
		echo '<div id="extend-offer"><div class="various" href="#gform-extend-form-'. $gform_extend_id . '"><a href="' . $gform_extend_url . '" target="_blank" >' . $extend_offer . '</a></div></div>';
		echo '<div id="gform-consult-form-' .  $gform_consult_id . '" style="display:none;width:500px;">';
		echo do_shortcode('[gravityform id="'. $gform_consult_id . '" ajax="true"]');
		echo '</div>';
		echo '<div id="gform-extend-form-' .  $gform_extend_id . '" style="display:none;width:500px;">';
		echo do_shortcode('[gravityform id="'. $gform_extend_id . '" ajax="true"]');
		echo '</div>';
		echo $after_widget;
  }
}

/** Testimonials Widget **/
add_action( 'widgets_init', create_function( '', 'register_widget("gsdental_testimonials");'));
class gsdental_testimonials extends WP_Widget {
	function gsdental_testimonials() {
		$widget_options = array(
		'classname' => 'gsdental_testimonials',
		'description' => 'Testimonials' );
		parent::WP_Widget("gsdental_testimonials", "Testimonials", $widget_options);
	}
 
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'testimonial_title' => '', 'testimonial_seeall' => '', 'testimonial_seeallurl' => '') );
		$testimonial_title = $instance['testimonial_title'];
		$testimonial_seeall = $instance['testimonial_seeall'];
		$testimonial_seeallurl = $instance['testimonial_seeallurl'];
		
		?>
		<p>
		<label for="<?php echo $this->get_field_id('testimonial_title'); ?>">Title:</label>
		<input id="<?php echo $this->get_field_id( 'testimonial_title' ); ?>" name="<?php echo   $this->get_field_name( 'testimonial_title' ); ?>" type="text" value="<?php echo $testimonial_title ?>"   />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('testimonial_seeall'); ?>">See All Title:</label>
		<input id="<?php echo $this->get_field_id( 'testimonial_seeall' ); ?>" name="<?php echo   $this->get_field_name( 'testimonial_seeall' ); ?>" type="text" value="<?php echo $testimonial_seeall ?>"   />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('testimonial_seeallurl'); ?>">See All URL:</label>
		<input id="<?php echo $this->get_field_id( 'testimonial_seeallurl' ); ?>" name="<?php echo   $this->get_field_name( 'testimonial_seeallurl' ); ?>" type="text" value="<?php echo $testimonial_seeallurl ?>" />
		</p>
		<?php
	}
 
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['testimonial_title'] = $new_instance['testimonial_title'];
		$instance['testimonial_seeall'] = $new_instance['testimonial_seeall'];
		$instance['testimonial_seeallurl'] = $new_instance['testimonial_seeallurl'];
		return $instance;
	}
  
	public function widget( $args, $instance ) {
		extract( $args );
		$testimonial_title = apply_filters( 'widget_title', $instance['testimonial_title'] );
		$testimonial_seeall = apply_filters( 'widget_title', $instance['testimonial_seeall'] );
		$testimonial_seeallurl = apply_filters( 'widget_title', $instance['testimonial_seeallurl'] );
		
		echo $before_widget;
		echo '<h2 class="widget-title">'.$testimonial_title.'</h2>';
		echo '<div id="cycle" style="height:auto!important;max-height:300px!important;">';
		
		$slider_args = array('post_type' => 'testimonials', 'posts_per_page' => -1);
		$loop = new WP_Query($slider_args);
		while ($loop->have_posts()) : $loop->the_post();
			//echo '<div class="the-testimonial"><div class="testimonial-content">' . get_the_content() . '</div>';
			echo '<div class="the-testimonial"><div class="testimonial-excerpt">'. get_the_excerpt() . '</div>';
			echo '<div class="testimonial-title"> &mdash; ' . get_the_title() . '</div></div>';
		endwhile;
			
		echo '</div>';
		echo '<div id="testimonial-nav">';
		echo '<a href="#"><span id="prev">Prev</span></a>'; 
		echo '<a href="'. $testimonial_seeallurl .'"><span id="seeall">'. $testimonial_seeall .'</span></a>'; 
		echo '<a href="#"><span id="next">Next</span></a>';
		echo '</div>';
		echo $after_widget;
	}
}

/** Before and After Widget **/
add_action( 'widgets_init', create_function( '', 'register_widget("gsdental_before_after");'));
class gsdental_before_after extends WP_Widget {
	function gsdental_before_after() {
		$widget_options = array(
		'classname' => 'gsdental_before_after',
		'description' => 'Before and Afters' );
		parent::WP_Widget("gsdental_before_after", "Before and Afters", $widget_options);
	}
	
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'before_after_title' => '') );
		$before_after_title = $instance['before_after_title'];
		
		?>
		<p>
		<label for="<?php echo $this->get_field_id('before_after_title'); ?>">Title:</label>
		<input id="<?php echo $this->get_field_id( 'before_after_title' ); ?>" name="<?php echo   $this->get_field_name( 'before_after_title' ); ?>" type="text" value="<?php echo $before_after_title ?>"   />
		</p>
		<?php
	}
 
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['before_after_title'] = $new_instance['before_after_title'];
		return $instance;
	}
  
	public function widget( $args, $instance ) {
		extract( $args );
		$before_after_title = apply_filters( 'widget_title', $instance['before_after_title'] );
		
		echo $before_widget;
		echo '<h2 class="widget-title">'.$before_after_title.'</h2>';
		echo '<ul id="before-after-cycle">';
		
		$before_after_args = array('post_type' => 'before-and-afters', 'posts_per_page' => -1);
		$before_after_loop = new WP_Query($before_after_args);
		while ($before_after_loop->have_posts()) : $before_after_loop->the_post();
			echo the_post_thumbnail();
		endwhile;
			
		echo '</ul>';
		echo '<div id="before-after-nav">';
		echo '<a href="#"><span id="before-after-prev">Prev</span></a>'; 
		echo  '<a href="#"><span id="before-after-next">Next</span></a>';
		echo '</div>';
		echo $after_widget;
	}
}

/** Office Images Widget **/
add_action( 'widgets_init', create_function( '', 'register_widget("gsdental_office_images");'));
class gsdental_office_images extends WP_Widget {
	function gsdental_office_images() {
		$widget_options = array(
		'classname' => 'gsdental_office_images',
		'description' => 'Office Images' );
		parent::WP_Widget("gsdental_office_images", "Office Images", $widget_options);
	}
	
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'office_images_title' => '') );
		$office_images_title = $instance['office_images_title'];
		
		?>
		<p>
		<label for="<?php echo $this->get_field_id('office_images_title'); ?>">Title:</label>
		<input id="<?php echo $this->get_field_id( 'office_images_title' ); ?>" name="<?php echo   $this->get_field_name( 'office_images_title' ); ?>" type="text" value="<?php echo $office_images_title ?>"   />
		</p>
		<?php
	}
 
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['office_images_title'] = $new_instance['office_images_title'];
		return $instance;
	}
  
	public function widget( $args, $instance ) {
		extract( $args );
		$office_images_title = apply_filters( 'widget_title', $instance['office_images_title'] );
		
		echo $before_widget;
		echo '<h2 class="widget-title">'.$office_images_title.'</h2>';
		echo '<ul id="office-images-cycle">';
		
		$office_images_args = array('post_type' => 'office-images', 'posts_per_page' => -1);
		$office_images_loop = new WP_Query($office_images_args);
		while ($office_images_loop->have_posts()) : $office_images_loop->the_post();
			echo the_post_thumbnail();
		endwhile;
			
		echo '</ul>';
		echo '<div id="office-images-nav">';
		echo '<a href="#"><span id="office-images-prev">Prev</span></a>'; 
		echo  '<a href="#"><span id="office-images-next">Next</span></a>';
		echo '</div>';
		echo $after_widget;
	}
}
?>