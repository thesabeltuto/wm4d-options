<?php
/** OFFERS CUSTOM TYPE **/
//add_action( 'init', 'custom_post_offers' );
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

?>