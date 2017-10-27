<?php
/** PROCEDURE CUSTOM TYPE **/
//add_action( 'init', 'custom_post_procedures' );
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
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'post-formats', 'revisions' ),
		'has_archive'   => true,
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

/*
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
*/
?>