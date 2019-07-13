<?php
/**
 *
 * Custom post types and taxonomies
 *
 * После создания нового типа надо зайти в Setiings - Permalinks и нажаь кнопку Сохранить, чтобы Wordpress праивльно раотал с новым типом (выводил single-{post-type}.php, например)
 *
 * @package aero
 */


/*
 * Custom post type and taxonomy for Tours block
*/


function create_tours_posttype() {
		$args = array(
			'labels' => array(
				'name' => __( 'Virtual Tours', 'aero' ),
				'singular_name' => __( 'Virtual Tour', 'aero' )
			),
			'public' => true,
			//'menu_icon' => 'dashicons-images-alt',
			'capability_type' => 'post',
			'label'  => 'virtual_tour',
			'supports' => array( 'title', 'editor', 'custom-fields', 'thumbnail', 'page-attributes')
		);
		register_post_type( 'aero_tour', $args );
}

add_action( 'init', 'create_tours_posttype' );


function create_tours_taxonomy() {

// Labels part for the GUI

	$labels = array(
		'name' => _x( 'Virtual Tours Types', 'taxonomy general name', 'aero' ),
		'singular_name' => _x( 'Virtual Tour Type', 'taxonomy singular name', 'aero' ),
		'search_items' =>  __( 'Search Virtual Tours' ),
		'popular_items' => __( 'Popular Virtual Tours' ),
		'all_items' => __( 'All Virtual Tours' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Virtual Tour' ),
		'update_item' => __( 'Update Virtual Tour' ),
		'add_new_item' => __( 'Add New Virtual Tour' ),
		'new_item_name' => __( 'New Virtual Tour Type Name' ),
		'separate_items_with_commas' => __( 'Separate Virtual Tour types with commas' ),
		'add_or_remove_items' => __( 'Add or remove Virtual Tour types' ),
		'choose_from_most_used' => __( 'Choose from the most used Virtual Tour types' ),
		'menu_name' => __( 'Virtual Tour Types' ),
	);

// Now register the non-hierarchical taxonomy like tag

	register_taxonomy('tours_taxonomy','aero_tour', array(
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array( 'slug' => 'tour' ),
	));
}


add_action( 'init', 'create_tours_taxonomy', 0 );


/*
 * Custom post type and taxonomy for Video posts
*/
function create_video_posttype() {
		$args = array(
			'labels' => array(
				'name' => __( 'Aero Videos', 'aero' ),
				'singular_name' => __( 'Aero Video', 'aero' )
			),
			'public' => true,
			//'menu_icon' => 'dashicons-images-alt',
			'capability_type' => 'post',
			'label'  => 'aero_video',
			'supports' => array( 'title', 'editor', 'custom-fields', 'thumbnail', 'page-attributes')
		);
		register_post_type( 'aero_video', $args );
}

add_action( 'init', 'create_video_posttype' );

function create_video_taxonomy() {

// Labels part for the GUI

	$labels = array(
		'name' => _x( 'Aero Videos Types', 'taxonomy general name', 'aero'  ),
		'singular_name' => _x( 'Aero Video Type', 'taxonomy singular name', 'aero'  ),
		'search_items' =>  __( 'Search Videos' ),
		'popular_items' => __( 'Popular Videos' ),
		'all_items' => __( 'All Videos' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Video' ),
		'update_item' => __( 'Update Video' ),
		'add_new_item' => __( 'Add New Video' ),
		'new_item_name' => __( 'New Video Type Name' ),
		'separate_items_with_commas' => __( 'Separate Video types with commas' ),
		'add_or_remove_items' => __( 'Add or remove Video types' ),
		'choose_from_most_used' => __( 'Choose from the most used Video types' ),
		'menu_name' => __( 'Video Types' ),
	);

// Now register the non-hierarchical taxonomy like tag

	register_taxonomy('video_taxonomy','aero_video', array(
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array( 'slug' => 'video' ),
	));
}


add_action( 'init', 'create_video_taxonomy', 0 );


/*
 * Custom taxonomy for Attachments
*/
// function create_attachment_taxonomy() {
// // Labels part for the GUI

//   $labels = array(
//     'name' => _x( 'Attachment Types', 'taxonomy general name', 'aero'  ),
//     'singular_name' => _x( 'Attachment Type', 'taxonomy singular name', 'aero'  ),
//     'search_items' =>  __( 'Search Attachments' ),
//     'popular_items' => __( 'Popular Attachments' ),
//     'all_items' => __( 'All Attachments' ),
//     'parent_item' => null,
//     'parent_item_colon' => null,
//     // 'edit_item' => __( 'Edit Attachment type' ),
//     // 'update_item' => __( 'Update Attachment type' ),
//     // 'add_new_item' => __( 'Add New Attachment type' ),
//     // 'new_item_name' => __( 'New Attachment type name' ),
//     'separate_items_with_commas' => __( 'Separate Attachment types with commas' ),
//     'add_or_remove_items' => __( 'Add or remove Attachment types' ),
//     'choose_from_most_used' => __( 'Choose from the most used Attachment types' ),
//     'menu_name' => __( 'Attachment types' ),
//   );

// // Now register the non-hierarchical taxonomy like tag

//   register_taxonomy('attachment_taxonomy','attachment', array(
//     'hierarchical' => false,
//     'labels' => $labels,
//     'show_ui' => true,
//     'show_admin_column' => true,
//     // 'update_count_callback' => '_update_post_term_count',
//     'query_var' => true,
//     'rewrite' => 'true',
//   ));
// }


// add_action( 'init', 'create_attachment_taxonomy', 0 );
