<?php
/** BEFORE & AFTERS CUSTOM POST **/
//add_action( 'init', 'custom_post_before_and_afters' );
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
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'images', 'revisions' ),
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

add_action( 'init', 'wm4d_taxonomies_before_and_afters', 0 );
function wm4d_taxonomies_before_and_afters() {
	$labels = array(
		'name'              => _x( 'Before & Afters Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Before & Afters Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Before & Afters Categories' ),
		'all_items'         => __( 'All Before & Afters Categories' ),
		'parent_item'       => __( 'Parent Before & Afters Category' ),
		'parent_item_colon' => __( 'Parent Before & Afters Category:' ),
		'edit_item'         => __( 'Edit Before & Afters Category' ), 
		'update_item'       => __( 'Update Before & Afters Category' ),
		'add_new_item'      => __( 'Add New Before & Afters Category' ),
		'new_item_name'     => __( 'New Before & Afters Category' ),
		'menu_name'         => __( 'Before & Afters Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'before_and_afters_categories', 'before-and-afters', $args );
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
		$instance = wp_parse_args( (array) $instance, array( 'before_after_title' => '', 'before_after_category' => '') );
		$before_after_title = $instance['before_after_title'];
		$before_after_category = $instance['before_after_category'];
		
		?>
		<p>
		<label for="<?php echo $this->get_field_id('before_after_title'); ?>">Title:</label>
		<input id="<?php echo $this->get_field_id( 'before_after_title' ); ?>" name="<?php echo   $this->get_field_name( 'before_after_title' ); ?>" type="text" value="<?php echo $before_after_title ?>"   />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('before_after_category'); ?>">Category Slug:</label>
		<input id="<?php echo $this->get_field_id( 'before_after_category' ); ?>" name="<?php echo   $this->get_field_name( 'before_after_category' ); ?>" type="text" value="<?php echo $before_after_category ?>"   />
		</p>
		<?php
	}
 
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['before_after_title'] = $new_instance['before_after_title'];
		$instance['before_after_category'] = $new_instance['before_after_category'];
		return $instance;
	}
  
	public function widget( $args, $instance ) {
		extract( $args );
		$before_after_title = apply_filters( 'widget_title', $instance['before_after_title'] );
		$before_after_category = apply_filters( 'widget_categories_args', $instance['before_after_category'] );
		
		echo $before_widget;
        $before_after_args = array('post_type' => 'before-and-afters', 'posts_per_page' => -1,'meta_key'=>'_thumbnail_id', 'before_and_afters_categories'=>$before_after_category);
        $before_after_loop = new WP_Query($before_after_args);
        if($before_after_loop->found_posts>0) {
            echo '<h2 class="widget-title">' . $before_after_title . '</h2>';
            echo '<ul id="before-after-cycle">';
            while ($before_after_loop->have_posts()) : $before_after_loop->the_post();
                echo the_post_thumbnail();
            endwhile;
            echo '</ul>';
            if($before_after_loop->found_posts>1) {
                echo '<div id="before-after-nav">';
                echo '<a href="#"><span id="before-after-prev">Prev</span></a>';
                echo '<a href="#"><span id="before-after-next">Next</span></a>';
                echo '</div>';
            }
        }
		echo $after_widget;
	}
}
?>