<?php
/** TESTIMONIALS CUSTOM TYPE **/
//add_action( 'init', 'custom_post_testimonials' );
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
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions' ),
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
		$instance = wp_parse_args( (array) $instance, array( 'testimonial_title' => '', 'testimonial_seeall' => '', 'testimonial_seeallurl' => '', 'testimonial_category' => '') );
		$testimonial_title = $instance['testimonial_title'];
		$testimonial_category = $instance['testimonial_category'];
		$testimonial_seeall = $instance['testimonial_seeall'];
		$testimonial_seeallurl = $instance['testimonial_seeallurl'];
		
		?>
		<p>
		<label for="<?php echo $this->get_field_id('testimonial_title'); ?>">Title:</label>
		<input id="<?php echo $this->get_field_id( 'testimonial_title' ); ?>" name="<?php echo   $this->get_field_name( 'testimonial_title' ); ?>" type="text" value="<?php echo $testimonial_title ?>"   />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('testimonial_category'); ?>">Category:</label>
		<input id="<?php echo $this->get_field_id( 'testimonial_category' ); ?>" name="<?php echo   $this->get_field_name( 'testimonial_category' ); ?>" type="text" value="<?php echo $testimonial_category ?>"   />
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
		$instance['testimonial_category'] = $new_instance['testimonial_category'];
		$instance['testimonial_seeall'] = $new_instance['testimonial_seeall'];
		$instance['testimonial_seeallurl'] = $new_instance['testimonial_seeallurl'];
		return $instance;
	}
  
	public function widget( $args, $instance ) {
		extract( $args );
		$testimonial_title = apply_filters( 'widget_title', $instance['testimonial_title'] );
		$testimonial_category = apply_filters( 'widget_title', $instance['testimonial_category'] );
		$testimonial_seeall = apply_filters( 'widget_title', $instance['testimonial_seeall'] );
		$testimonial_seeallurl = apply_filters( 'widget_title', $instance['testimonial_seeallurl'] );
		
		echo $before_widget;
		echo '<h2 class="widget-title">'.$testimonial_title.'</h2>';
		echo '<div id="cycle" style="height:auto!important;max-height:300px!important;">';
		
		$slider_args = array('post_type' => 'testimonials', 'posts_per_page' => -1, 'testimonial_categories' => $testimonial_category );
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
?>