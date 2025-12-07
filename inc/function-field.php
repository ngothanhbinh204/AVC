<?php
function add_field_select_banner()
{
	acf_add_local_field_group(array(
		'key' => 'select_banner',
		'title' => 'Banner: Select Page',
		'fields' => array(),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
			),
			// Thêm taxonomy ở dưới
			array(
				array(
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'category'
				)
			),
			array(
				array(
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'product-tax'
				)
			),
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product'
				)
			)
		),
	));
	acf_add_local_field(array(
		'key' => 'banner_select_page',
		'label' => 'Chọn banner hiển thị',
		'name' => 'Chọn banner hiển thị',
		'type' => 'post_object',
		'post_type' => 'banner',
		'multiple' => 1,
		'parent' => 'select_banner',
	));
}
add_action('acf/init', 'add_field_select_banner');

function pp_create_post_type($args)
{

	if (!is_array($args) || !$args['post_type'] || !$args['name'] || !$args['single'] || !$args['slug']) return;

	$post_type = $args['post_type'];

	$name = $args['name'];

	$single = $args['single'];

	$icon = $args['icon'] ? $args['icon'] : "dashicons-star-filled";

	$archive = isset($args['archive']) ? $args['archive'] : true;

	$slug = $args['slug'];

	$rewrite = (isset($args['rewrite'])) ? $args['rewrite'] : $args['slug'];

	$supports = isset($args['supports']) ? $args['supports'] : array('title', 'editor', 'revisions', 'thumbnail', 'author', 'excerpt', 'comments');

	$public = isset($args['public']) ? $args['public'] : true;

	$capabilities = isset($args['capabilities']) ? $args['capabilities'] : array();

	$exclude_from_search = isset($args['exclude_from_search']) ? $args['exclude_from_search'] : true;

	register_post_type($post_type, array(
		'labels' => array(

			'name' => __($name, 'pp'),

			'singular_name' => __($single, 'pp'),

			'add_new' => __('Add New ' . $single, 'pp'),

			'add_new_item' => __('Add New ' . $single, 'pp'),


			'edit_item' => __('Edit ' . $single, 'pp'),


			'new_item' => __('New' . $single, 'pp'),


			'all_items' => __('All ' . $name, 'pp'),


			'view_item' => __('View ' . $single, 'pp'),


			'search_items' => __('Filter By ' . $name, 'pp'),


			'not_found' => __('Not Found ' . $single, 'pp'),


			'not_found_in_trash' => __('Not Found ' . $single . ' In Trash', 'pp'),


			'parent_item_colon' => '',


			'menu_name' => __($name, 'pp')


		),


		'public' => $public,


		'exclude_from_search' => $exclude_from_search,


		'menu_position' => 6,


		'menu_icon' => $icon,


		'has_archive' => $archive,


		'taxonomies' => array($post_type),


		'rewrite' => array('slug' => $rewrite),


		'publicly_queryable' => $public,


		'supports' => $supports,


		'capabilities' => $capabilities,


	));
}
add_action('init', 'create_new_custom_post_type');


function create_new_custom_post_type()
{
	$args = array(
		array(
			"post_type" => 'product',
			"name" => __('Sản phẩm', 'canhcamtheme'),
			"single" => __('Sản phẩm', 'canhcamtheme'),
			"slug" => "product",
			"rewrite" => "product",
			"supports" => array('title', 'thumbnail', 'excerpt', 'editor'),
			"icon" => 'dashicons-products',
			"archive" => false,
			"exclude_from_search" => false,
		),

	);
	foreach ($args as $arg) {
		if ($arg['post_type']) {
			pp_create_post_type($arg);
		}
	}
}

function create_custom_taxonomies()
{
	$args = array(
		array(
			"post_type" => array('product'),
			"name" => __('Sản phẩm - Chuyên mục', 'canhcamtheme'),
			"single" => __('Sản phẩm - Chuyên mục', 'canhcamtheme'),
			"slug" => "product-tax",
			"rewrite" => "product-tax",
			"taxonomy" => "product-tax",
		),
	);
	foreach ($args as $arg) {
		if (!empty($arg['post_type'])) {
			pp_create_taxonomy($arg);
		}
	}
}

function pp_create_taxonomy($args)
{
	if (!is_array($args) || !$args['post_type'] || !$args['name'] || !$args['single'] || !$args['taxonomy'] || !$args['slug']) return;

	$post_type = $args['post_type'];

	$name = $args['name'];

	$single = $args['single'];

	$slug = $args['slug'];

	$rewrite = (isset($args['rewrite'])) ? $args['rewrite'] : $slug;

	$taxonomy = $args['taxonomy'];

	$hierarchical = isset($args['hierarchical']) ? $args['hierarchical'] : true;

	$labels = array(

		'name' => __($name, 'pp'),

		'singular_name' => __($single, 'pp'),

		'search_items' => __('Filter By ' . $name, 'pp'),

		'popular_items' => __('Popular ' . $name, 'pp'),

		'all_items' => __('All ' . $name, 'pp'),

		'parent_item' => null,

		'parent_item_colon' => null,

		'edit_item' => __('Edit ' . $single, 'pp'),

		'update_item' => __('Update ' . $single, 'pp'),

		'add_new_item' => __('Add New ' . $single, 'pp'),

		'new_item_name' => __('Add New ' . $single, 'pp'),

		'menu_name' => __($name, 'pp'),

	);


	$args = array(

		'hierarchical' => $hierarchical,

		'labels' => $labels,

		'show_ui' => true,

		'show_admin_column' => true,

		'query_var' => true,

		'rewrite' => array('slug' => $rewrite),

	);

	register_taxonomy($taxonomy, $post_type, $args);
}



add_action('init', 'create_custom_taxonomies');



/**
 * Set initial values for the "banner-field" taxonomy.
 */
function set_banner_field_initial_values()
{
	// Check if the taxonomy already exists
	if (taxonomy_exists('banner-field')) {
		// Array of initial values with their corresponding names
		$initial_values = array(
			'main-banner' => 'Main Banner',
			'page-banner' => 'Page Banner'
		);

		// Loop through the initial values and check if they exist, if not, insert them
		foreach ($initial_values as $value => $name) {
			if (!term_exists($value, 'banner-field')) {
				wp_insert_term($name, 'banner-field', array('slug' => $value));
			}
		}
	}
}
add_action('init', 'set_banner_field_initial_values');
