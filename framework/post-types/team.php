<?php
/** TEAM CUSTOM TYPE **/
function custom_post_team() {
	$labels = array(
		'name'               => _x( 'Team Members', 'post type general name' ),
		'singular_name'      => _x( 'Team Member', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'team' ),
		'add_new_item'       => __( 'Add New Team Member' ),
		'edit_item'          => __( 'Edit Team Member' ),
		'new_item'           => __( 'New Team Member' ),
		'all_items'          => __( 'All Team Members' ),
		'view_item'          => __( 'View Team Member' ),
		'search_items'       => __( 'Search Team Members' ),
		'not_found'          => __( 'No team found' ),
		'not_found_in_trash' => __( 'No team found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Team Members'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our team and team specific data',
		'public'        => true,
		'menu_position' => 7,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions' ),
		'has_archive'   => true,
	);
	register_post_type( 'team', $args );	
}

add_filter( 'post_updated_messages', 'custom_post_team_messages' );
function custom_post_team_messages( $messages ) {
	global $post, $post_ID;
	$messages['team'] = array(
		0 => '', 
		1 => sprintf( __('Team Member updated. <a href="%s">View Team Member</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Team Member updated.'),
		5 => isset($_GET['revision']) ? sprintf( __('Team Member restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Team Member published. <a href="%s">View team</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Team Member saved.'),
		8 => sprintf( __('Team Member submitted. <a target="_blank" href="%s">Preview team</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Team Member scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview team</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Team Member draft updated. <a target="_blank" href="%s">Preview team</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
}

add_action( 'init', 'gsdental_taxonomies_team', 0 );
function gsdental_taxonomies_team() {
	$labels = array(
		'name'              => _x( 'Team Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Team Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Team Categories' ),
		'all_items'         => __( 'All Team Categories' ),
		'parent_item'       => __( 'Parent Team Category' ),
		'parent_item_colon' => __( 'Parent Team Category:' ),
		'edit_item'         => __( 'Edit Team Category' ), 
		'update_item'       => __( 'Update Team Category' ),
		'add_new_item'      => __( 'Add New Team Category' ),
		'new_item_name'     => __( 'New Team Category' ),
		'menu_name'         => __( 'Team Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'team-category', 'team', $args );
}
?>