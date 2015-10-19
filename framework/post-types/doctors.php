<?php
/** DOCTORS CUSTOM TYPE **/
function custom_post_doctors() {
	$labels = array(
		'name'               => _x( 'Doctors', 'post type general name' ),
		'singular_name'      => _x( 'Doctor', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'doctors' ),
		'add_new_item'       => __( 'Add New Doctor' ),
		'edit_item'          => __( 'Edit Doctor' ),
		'new_item'           => __( 'New Doctor' ),
		'all_items'          => __( 'All Doctors' ),
		'view_item'          => __( 'View Doctor' ),
		'search_items'       => __( 'Search Doctors' ),
		'not_found'          => __( 'No doctors found' ),
		'not_found_in_trash' => __( 'No doctors found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Doctors'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our doctors and doctor specific data',
		'public'        => true,
		'menu_position' => 7,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions' ),
		'has_archive'   => true,
	);
	register_post_type( 'doctors', $args );	
}

add_filter( 'post_updated_messages', 'custom_post_doctor_messages' );
function custom_post_doctor_messages( $messages ) {
	global $post, $post_ID;
	$messages['doctors'] = array(
		0 => '', 
		1 => sprintf( __('Doctor updated. <a href="%s">View Doctor</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Doctor updated.'),
		5 => isset($_GET['revision']) ? sprintf( __('Doctor restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Doctor published. <a href="%s">View doctor</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Doctor saved.'),
		8 => sprintf( __('Doctor submitted. <a target="_blank" href="%s">Preview doctor</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Doctor scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview doctor</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Doctor draft updated. <a target="_blank" href="%s">Preview doctor</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
}

add_action( 'init', 'gsdental_taxonomies_doctors', 0 );
function gsdental_taxonomies_doctors() {
	$labels = array(
		'name'              => _x( 'Doctor Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Doctor Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Doctor Categories' ),
		'all_items'         => __( 'All Doctor Categories' ),
		'parent_item'       => __( 'Parent Doctor Category' ),
		'parent_item_colon' => __( 'Parent Doctor Category:' ),
		'edit_item'         => __( 'Edit Doctor Category' ), 
		'update_item'       => __( 'Update Doctor Category' ),
		'add_new_item'      => __( 'Add New Doctor Category' ),
		'new_item_name'     => __( 'New Doctor Category' ),
		'menu_name'         => __( 'Doctor Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'doctors-category', 'doctors', $args );
}
?>