<?php

// Show chức năng menu
add_theme_support('menus');
// Đăng ký vị trí menu
function register_my_menu()
{
    $locations = array(
        'main-menu' => __('Main Menu', 'canhcamtheme'),
        'footer-1' => __('Footer 1', 'canhcamtheme'),
        'footer-2' => __('Footer 2', 'canhcamtheme'),
        'footer-3' => __('Footer 3', 'canhcamtheme'),
    );
    register_nav_menus($locations);
}
add_action('init', 'register_my_menu');
// Tạo theme options
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'     => 'Theme options', // Title hiển thị khi truy cập vào Options page
        'menu_title'    => 'Theme options', // Tên menu hiển thị ở khu vực admin
        'menu_slug'     => 'theme-settings', // Url hiển thị trên đường dẫn của options page
        'capability'    => 'edit_posts',
        'redirect'    => false
    ));
}
// Tạo Slider
function slider_custom_post_type()
{
    /*
     * Biến $label để chứa các text liên quan đến tên hiển thị của Post Type trong Admin
     */
    $label = array(
        'name' => 'Banner', //Tên post type dạng số nhiều
        'singular_name' => 'Banner', //Tên post type dạng số ít
        'view_item'           => 'Xem Banner',
        'add_new_item'        => 'Thêm Banner Mới',
        'add_new'             => 'Thêm Banner',
        'edit_item'           => 'Chỉnh sửa Banner',
        'update_item'         => 'Update Banner',
        // 'search_items'        => __( 'Search Movie', 'twentytwenty' ),
        // 'not_found'           => __( 'Not Found', 'twentytwenty' ),
        // 'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwenty' ),
    );

    /*
     * Biến $args là những tham số quan trọng trong Post Type
     */
    $args = array(
        'labels' => $label, //Gọi các label trong biến $label ở trên
        'description' => 'Ảnh banner', //Mô tả của post type
        'supports' => array(
            'title',
            // 'editor',
            'thumbnail',
        ), //Các tính năng được hỗ trợ trong post type
        'taxonomies' => array('pages'), //Các taxonomy được phép sử dụng để phân loại nội dung
        'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, true thì giống như Page
        'public' => true, //Kích hoạt post type
        'show_ui' => true, //Hiển thị khung quản trị như Post/Page
        'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
        'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
        'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
        'menu_position' => 5, //Thứ tự vị trí hiển thị trong menu (tay trái)
        'menu_icon' => 'dashicons-slides', //Đường dẫn tới icon sẽ hiển thị
        'can_export' => true, //Có thể export nội dung bằng Tools -> Export
        'has_archive' => true, //Cho phép lưu trữ (month, date, year)
        'exclude_from_search' => false, //Loại bỏ khỏi kết quả tìm kiếm
        'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
        'capability_type' => 'post' //
    );
    register_post_type('banner', $args); //Tạo post type với slug tên  và các tham số trong biến $args ở trên
}
add_action('init', 'slider_custom_post_type');
// Add Features Images
add_theme_support('post-thumbnails');
// Edit Link
function edit_link_post($id)
{
    if (is_object($id))
        $id = $id->ID;
    $urlEditLink = get_edit_post_link($id);
    if (current_user_can('edit_post', $id)) {
        return '<a class="edit-link-post" target="_blank" style="font-size:18px; color:red;pointer-events:auto;" href="' . $urlEditLink . '"><span class="dashicons dashicons-edit"></span></a>';
    }
    return null;
}
function edit_link_term($id)
{
    $term = get_term($id);

    if (!is_wp_error($term)) {
        // Term retrieved successfully
        if (is_taxonomy_hierarchical($term->taxonomy)) {
            // Term belongs to a custom hierarchical taxonomy
            $taxonomy = get_taxonomy($term->taxonomy);
            $post_type = $taxonomy->object_type[0];
            $urlEditLink = add_query_arg(
                array(
                    'taxonomy' => $term->taxonomy,
                    'tag_ID' => $term->term_id,
                    'post_type' => $post_type,
                ),
                admin_url('term.php')
            );
        } else {
            // Term belongs to a custom non-hierarchical taxonomy
            $urlEditLink = add_query_arg(
                array(
                    'taxonomy' => $term->taxonomy,
                    'tag_ID' => $term->term_id,
                ),
                admin_url('edit-tags.php')
            );
        }
    } else {
        // Term not found or error occurred
        $category = get_category($id);

        if ($category) {
            // Category retrieved successfully
            $category_name = $category->name;
            $category_link = get_category_link($category);
            $category_link_html = '<a href="' . $category_link . '">' . $category_link . '</a>';

            if (current_user_can('edit_posts')) { // Use a valid capability string here
                return '<a class="edit-term-post" target="_blank" style="font-size:18px; color:red;" href="' . $category_link . '"><span class="dashicons dashicons-admin-generic"></span></a> Category Name: ' . $category_name . '<br>Category Link: ' . $category_link_html;
            } else {
                return 'Category Name: ' . $category_name . '<br>Category Link: ' . $category_link_html;
            }
        } else {
            // Category not found
            return 'Invalid ID or Category not found.';
        }
    }

    if (current_user_can('edit_posts')) { // Use a valid capability string here
        return '<a class="edit-term-post" target="_blank" style="font-size:18px; color:red;" href="' . $urlEditLink . '"><span class="dashicons dashicons-admin-generic"></span></a>';
    }

    return null;
}

// Allow SVG
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
if (is_admin()) {
    define('ALLOW_UNFILTERED_UPLOADS', true);
}
// Clone page or post
/*
 * Function for post duplication. Dups appear as drafts. User is redirected to the edit screen
 */
function rd_duplicate_post_as_draft()
{
    global $wpdb;
    if (!(isset($_GET['post']) || isset($_POST['post'])  || (isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action']))) {
        wp_die('No post to duplicate has been supplied!');
    }
    /*
   * Nonce verification
   */
    if (!isset($_GET['duplicate_nonce']) || !wp_verify_nonce($_GET['duplicate_nonce'], basename(__FILE__)))
        return;
    /*
   * get the original post id
   */
    $post_id = (isset($_GET['post']) ? absint($_GET['post']) : absint($_POST['post']));
    /*
   * and all the original post data then
   */
    $post = get_post($post_id);
    /*
   * if you don't want current user to be the new post author,
   * then change next couple of lines to this: $new_post_author = $post->post_author;
   */
    $current_user = wp_get_current_user();
    $new_post_author = $current_user->ID;
    /*
   * if post data exists, create the post duplicate
   */
    if (isset($post) && $post != null) {
        /*
     * new post data array
     */
        $args = array(
            'comment_status' => $post->comment_status,
            'ping_status'    => $post->ping_status,
            'post_author'    => $new_post_author,
            'post_content'   => $post->post_content,
            'post_excerpt'   => $post->post_excerpt,
            'post_name'      => $post->post_name,
            'post_parent'    => $post->post_parent,
            'post_password'  => $post->post_password,
            'post_status'    => 'draft',
            'post_title'     => $post->post_title,
            'post_type'      => $post->post_type,
            'to_ping'        => $post->to_ping,
            'menu_order'     => $post->menu_order
        );
        /*
     * insert the post by wp_insert_post() function
     */
        $new_post_id = wp_insert_post($args);
        /*
     * get all current post terms ad set them to the new post draft
     */
        $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
        foreach ($taxonomies as $taxonomy) {
            $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
            wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
        }
        /*
     * duplicate all post meta just in two SQL queries
     */
        $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
        if (count($post_meta_infos) != 0) {
            $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
            foreach ($post_meta_infos as $meta_info) {
                $meta_key = $meta_info->meta_key;
                if ($meta_key == '_wp_old_slug') continue;
                $meta_value = addslashes($meta_info->meta_value);
                $sql_query_sel[] = "SELECT $new_post_id, '$meta_key', '$meta_value'";
            }
            $sql_query .= implode(" UNION ALL ", $sql_query_sel);
            $wpdb->query($sql_query);
        }
        /*
     * finally, redirect to the edit post screen for the new draft
     */
        wp_redirect(admin_url('post.php?action=edit&post=' . $new_post_id));
        exit;
    } else {
        wp_die('Post creation failed, could not find original post: ' . $post_id);
    }
}
add_action('admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft');
/*
 * Add the duplicate link to action list for post_row_actions
 */
function rd_duplicate_post_link($actions, $post)
{
    if (current_user_can('edit_posts')) {
        $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce') . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
    }
    return $actions;
}
add_filter('post_row_actions', 'rd_duplicate_post_link', 10, 2);
add_filter('page_row_actions', 'rd_duplicate_post_link', 10, 2);
// Register sidebar and Classic widget
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Cột bên',
        'id' => 'sidebar',
    ));
}
function example_theme_support()
{
    remove_theme_support('widgets-block-editor');
}
add_action('after_setup_theme', 'example_theme_support');
// Edit Slug Custom Post Types
function remove_custom_post_type_slug($post_link, $post)
{
    if ('products' === $post->post_type && 'publish' === $post->post_status) {
        $post_link = str_replace('/' . $post->post_type . '/', '/', $post_link);
    }
    if ('grounds' === $post->post_type && 'publish' === $post->post_status) {
        $post_link = str_replace('/' . $post->post_type . '/', '/', $post_link);
    }
    return $post_link;
}

add_filter('post_type_link', 'remove_custom_post_type_slug', 10, 2);
function add_post_names_to_main_query($query)
{
    // Bail if this is not the main query.
    if (!$query->is_main_query()) {
        return;
    }
    // Bail if this query doesn't match our very specific rewrite rule.
    if (!isset($query->query['page']) || 2 !== count($query->query)) {
        return;
    }
    // Bail if we're not querying based on the post name.
    if (empty($query->query['name'])) {
        return;
    }
    // Add CPT to the list of post types WP will include when it queries based on the post name.
    $query->set('post_type', array('post', 'page', 'products', 'grounds'));
}
add_action('pre_get_posts', 'add_post_names_to_main_query');

// Get Language current OUTPUT: echo do_shortcode('[language]')
function get_language_shortcode()
{
    return apply_filters('wpml_current_language', null);
}
add_shortcode('language', 'get_language_shortcode');

function get_id_language($id, $type = 'post', $language = '')
{
    if (isset($language)) {
        $language =  do_shortcode('[language]');
    }
    $id_page_translate = apply_filters('wpml_object_id', $id, $type, FALSE, $language);
    return $id_page_translate;
}


/**
 * Add class active tab
 */


/**
 * Get name menu from theme_location
 */

function get_name_menu($key_menu)
{
    $theme_locations = get_nav_menu_locations()[$key_menu];
    $name = wp_get_nav_menu_object($theme_locations);
    return $name->name;
}


function add_class_on_page_active($id_1, $id_2)
{
    return  $id_1 == $id_2 ? 'active' : '';
}

/**
 * Fix phân cấp của post category
 */

add_filter('wp_terms_checklist_args', 'my_website_wp_terms_checklist_args', 1, 2);
function my_website_wp_terms_checklist_args($args, $post_id)
{
    $args['checked_ontop'] = false;
    return $args;
}

/**
 * Fix bỏ phân trang của category ở Menu
 */


class Preserve_Page_and_Taxonomy_Hierarchy
{

    function __construct()
    {
        add_action('load-nav-menus.php', array($this, 'init'));
    }

    function init()
    {
        add_action('pre_get_posts',    array($this, 'disable_paging_for_hierarchical_post_types'));
        add_filter('get_terms_args',   array($this, 'remove_limit_for_hierarchical_taxonomies'), 10, 2);
        add_filter('get_terms_fields', array($this, 'remove_page_links_for_hierarchical_taxonomies'), 10, 3);
    }

    function disable_paging_for_hierarchical_post_types($query)
    {
        if (!is_admin() || 'nav-menus' !== get_current_screen()->id) {
            return;
        }

        if (!is_post_type_hierarchical($query->get('post_type'))) {
            return;
        }

        if (50 == $query->get('posts_per_page')) {
            $query->set('nopaging', true);
        }
    }

    function remove_limit_for_hierarchical_taxonomies($args, $taxonomies)
    {
        if (!is_admin() || 'nav-menus' !== get_current_screen()->id) {
            return $args;
        }

        if (!is_taxonomy_hierarchical(reset($taxonomies))) {
            return $args;
        }

        if (50 == $args['number']) {
            $args['number'] = '';
        }

        return $args;
    }

    function remove_page_links_for_hierarchical_taxonomies($selects, $args, $taxonomies)
    {
        if (!is_admin() || 'nav-menus' !== get_current_screen()->id) {
            return $selects;
        }

        if (!is_taxonomy_hierarchical(reset($taxonomies))) {
            return $selects;
        }

        if ('count' === $args['fields']) {
            $selects = array('1');
        }

        return $selects;
    }
}

new Preserve_Page_and_Taxonomy_Hierarchy;

/**
 * Get term depth
 */

function get_term_depth($taxonomy, $depth, $id_term = null)
{
    if (!$id_term) {
        $id_term = get_queried_object()->term_id;
    }
    $category_array = array();
    $id_parent = get_term_by('id', $id_term, $taxonomy);
    if ($id_parent->parent != 0) {
        while ($id_parent->parent != '0') {
            $term_id = $id_parent->parent;
            $id_parent = get_term_by('id', $term_id, $taxonomy);
            $category_array[] = $id_parent->term_id;
        }
    } else {
        $category_array[] = $id_parent->term_id;
    }
    $result = array_reverse($category_array);
    $depthInArray = count($result);
    if (($depthInArray - 1) < $depth) {
        return $id_term;
    } else {
        return $result[$depth];
    }
}

/**
 * Hidden user account
 */


function get_post_primary_category($post_id, $term = 'category', $return_all_categories = false)
{
    $return = array();

    if (class_exists('WPSEO_Primary_Term')) {
        // Show Primary category by Yoast if it is enabled & set
        $wpseo_primary_term = new WPSEO_Primary_Term($term, $post_id);
        $primary_term = get_term($wpseo_primary_term->get_primary_term());

        if (!is_wp_error($primary_term)) {
            $return['primary_category'] = $primary_term;
        }
    }

    if (empty($return['primary_category']) || $return_all_categories) {
        $categories_list = get_the_terms($post_id, $term);

        if (empty($return['primary_category']) && !empty($categories_list)) {
            $return['primary_category'] = $categories_list[0];  //get the first category
        }
        if ($return_all_categories) {
            $return['all_categories'] = array();

            if (!empty($categories_list)) {
                foreach ($categories_list as &$category) {
                    $return['all_categories'][] = $category->term_id;
                }
            }
        }
    }

    return $return;
};


function log_dump($data)
{
    ob_start();
    var_dump($data);
    $dump = ob_get_clean();

    $highlighted = highlight_string("<?php\n" . $dump . "\n?>", true);

$formatted = '
<pre>' . substr($highlighted, 27, -8) . '</pre>';

// Add custom CSS styles for the .php and .hlt classes
$custom_css = 'pre {position: static;
background: #ccc;
max-width: 100vw;
width: 100%;
}
pre::-webkit-scrollbar{
width: 1rem;}';

$formatted_css='<style>
'. $custom_css . '
</style>';
echo ($formatted_css . $formatted);
}

function empty_content($str)
{
return trim(str_replace('&nbsp;', '', strip_tags($str, '<img>'))) == '';
}



function get_page_parent($post)
{
if ($post->post_parent === 0) {
return $post->ID;
} else {
$current_parent_id = $post->post_parent;
while ($current_parent_id !== 0) {
$post_parent = get_post($current_parent_id);
$current_parent_id = $post_parent->post_parent;
}
return $post_parent->ID;
}
}

/**
* Get image attractment
*/

function changeAttrImage($url)
{
$image_output = $url;
// Thêm class lozad và thay đổi src thành data-src
$image_output = str_replace('class="', 'class="lozad ', $image_output);
$image_output = str_replace('src="',
'src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="', $image_output);
return $image_output;
}
function get_image_attachment($image, $type = "image")
{
// Get image ID from different formats
$image_id = null;
if (is_array($image)) {
// Check for 'ID' (uppercase) or 'id' (lowercase)
$image_id = !empty($image['ID']) ? $image['ID'] : (!empty($image['id']) ? $image['id'] : null);
} elseif (is_numeric($image)) {
$image_id = $image;
}

if ($type == "image") {
if ($image_id) {
$alt = get_post_meta($image_id, '_wp_attachment_image_alt', true) != '' ? get_post_meta($image_id,
'_wp_attachment_image_alt', true) : get_bloginfo('name');
$url = wp_get_attachment_image($image_id, 'full', '', array('class' => '', 'alt' => $alt, 'title' => $alt));
return changeAttrImage($url);
}
}
if ($type == "url") {
if ($image_id) {
$url = wp_get_attachment_image_url($image_id, 'full');
return $url;
}
}
return '';
}
// get img post
function get_image_post($id, $type = "image")
{
if ($type == "image") {
$alt = get_the_post_thumbnail_caption($id) != '' ? get_the_post_thumbnail_caption($id) : get_the_title($id);
$url = get_the_post_thumbnail($id, 'full', array('class' => '', 'alt' => $alt, 'title' => $alt));
return changeAttrImage($url);
}
if ($type == "url") {
$url = get_the_post_thumbnail_url($id, 'full', array('class' => ''));
return $url;
}
}

function get_video_thumbnail($post_id) {
if (has_post_thumbnail($post_id)) {
return get_image_post($post_id);
}
$default = get_template_directory_uri() . '/assets/images/placeholder-video.jpg';

return '
<img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
    data-src="'. $default .'" alt="Video Thumbnail" />
';
}
function normalize_youtube_url($url) {
if (!$url) return '';

// Chuyển Shorts → watch?v=
if (strpos($url, '/shorts/') !== false) {
return str_replace('/shorts/', '/watch?v=', $url);
}

return $url;
}

function get_video_thumbnail_image($post_id) {
if (has_post_thumbnail($post_id)) {
return get_image_post($post_id);
}

$fallback = get_template_directory_uri() . '/assets/images/placeholder-video.jpg';

return '
<img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
    data-src="' . $fallback . '" alt="Video Thumbnail" />
';
}



// Alias function để tương thích ngược
function get_image_attrachment($image, $type = "image") {
return get_image_attachment($image, $type);
}

add_filter('wp_lazy_loading_enabled', '__return_true');
/**
* Get ancesstor of post
*/

function get_post_categories($post_id)
{
// Ensure post ID is an integer
$post_id = intval($post_id);

// Get the categories for the post
$categories = get_the_category($post_id);

// Initialize an array to store category data
$category_data = array();

// Check if categories are retrieved successfully
if (!empty($categories) && !is_wp_error($categories)) {
// Loop through each category and store the ID and name
foreach ($categories as $category) {
$category_data[] = array(
'id' => $category->term_id,
'name' => $category->name,
);
}
}

// Return category data
return $category_data;
}