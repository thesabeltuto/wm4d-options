<?php
/** OFFICE IMAGES CUSTOM TYPE **/
//add_action( 'init', 'custom_post_office_images' );
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
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'post-formats', 'revisions' ),
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

add_action( 'init', 'wm4d_taxonomies_office_images', 0 );
function wm4d_taxonomies_office_images() {
	$labels = array(
		'name'              => _x( 'Office Images Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Office Images Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Office Images Categories' ),
		'all_items'         => __( 'All Office Images Categories' ),
		'parent_item'       => __( 'Parent Office Images Category' ),
		'parent_item_colon' => __( 'Parent Office Images Category:' ),
		'edit_item'         => __( 'Edit Office Images Category' ), 
		'update_item'       => __( 'Update Office Images Category' ),
		'add_new_item'      => __( 'Add New Office Images Category' ),
		'new_item_name'     => __( 'New Office Images Category' ),
		'menu_name'         => __( 'Office Images Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'office_images_categories', 'office-images', $args );
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
		$instance = wp_parse_args( (array) $instance, array( 'office_images_title' => '', 'office_images_category' => '') );
		$office_images_title = $instance['office_images_title'];
		$office_images_category = $instance['office_images_category'];
		
		?>
		<p>
		<label for="<?php echo $this->get_field_id('office_images_title'); ?>">Title:</label>
		<input id="<?php echo $this->get_field_id( 'office_images_title' ); ?>" name="<?php echo   $this->get_field_name( 'office_images_title' ); ?>" type="text" value="<?php echo $office_images_title ?>"   />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('office_images_category'); ?>">Category Slug:</label>
		<input id="<?php echo $this->get_field_id( 'office_images_category' ); ?>" name="<?php echo   $this->get_field_name( 'office_images_category' ); ?>" type="text" value="<?php echo $office_images_category ?>"   />
		</p>
		<?php
	}
 
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['office_images_title'] = $new_instance['office_images_title'];
		$instance['office_images_category'] = $new_instance['office_images_category'];
		return $instance;
	}
  
	public function widget( $args, $instance ) {
		extract( $args );
		$office_images_title = apply_filters( 'widget_title', $instance['office_images_title'] );
		$office_images_category = apply_filters( 'widget_categories_args', $instance['office_images_category'] );
				
		$office_images_args = array('post_type' => 'office-images', 'posts_per_page' => -1, 'office_images_categories' => $office_images_category );
		$office_images_loop = new WP_Query($office_images_args);
		if($office_images_loop->found_posts>0) {
			echo $before_widget;
			echo '<h2 class="widget-title">'.$office_images_title.'</h2>';
			echo '<ul id="office-images-cycle">';		
			while ($office_images_loop->have_posts()) : $office_images_loop->the_post();
				echo the_post_thumbnail();
			endwhile;
			echo '</ul>';
			if($office_images_loop->found_posts>1) {
				echo '<div id="office-images-nav">';
				echo '<a href="#"><span id="office-images-prev">Prev</span></a>'; 
				echo  '<a href="#"><span id="office-images-next">Next</span></a>';
				echo '</div>';
				
			}
		}
		echo $after_widget;
	}
}
?>