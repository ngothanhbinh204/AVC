<?php
function remove_editor()
{
    remove_post_type_support('post', 'editor');
}
// add_action('init', 'remove_editor');

function formatNumber($number)
{
    if (is_string($number)) {
        $number = stringToNumber($number);
    }
    if (!is_numeric($number)) {
        return "Invalid input";
    }
    if ($number > 1000) {
        return $number / 1000 . "N";
    } else {
        return $number;
    }
}

function stringToNumber($string)
{
    $number = 0;
    if (is_numeric($string)) {
        $number = (float) $string;
    }
    return $number;
};



// function fullpage_second_logo($wp_customize)
// {
//     // add a setting 
//     $wp_customize->add_setting('fullpage_second_logo');
//     // Add a control to upload the hover logo
//     $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'fullpage_second_logo', array(
//         'label' => 'Fullpage Second Logo | This logo only change on footer due to layout design',
//         'section' => 'title_tagline', //this is the section where the custom-logo from WordPress is
//         'settings' => 'fullpage_second_logo',
//         'priority' => 8 // show it just below the custom-logo
//     )));
// }

// add_action('customize_register', 'fullpage_second_logo');

function active_logo_customizer_setting($wp_customize)
{
    // add a setting 
    $wp_customize->add_setting('active_logo');
    // Add a control to upload the hover logo
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'active_logo', array(
        'label' => 'Active Logo',
        'section' => 'title_tagline', //this is the section where the custom-logo from WordPress is
        'settings' => 'active_logo',
        'priority' => 8 // show it just below the custom-logo
    )));
}

// add_action('customize_register', 'active_logo_customizer_setting');



// Wordpress + custom lozad

function custom_get_post_thumbnail($post_id, $size = 'full', $attr = '')
{
    if (is_array($post_id))
        $post_id = $post_id["ID"];
    $post_thumbnail_id = get_post_thumbnail_id($post_id);
    $image_attributes = wp_get_attachment_image_src($post_thumbnail_id, $size);
    $alt_text = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);
    if ($image_attributes) {
        $html = "<img width='" . $image_attributes[1] . "' height='" . $image_attributes[2] . "' data-src='" . esc_url($image_attributes[0]) . "' class='lozad'";
        if (empty($alt_text)) {
            $html .= 'alt="' . get_wp_title_rss('') . '"';
        } else {
            $html .= ' alt="' . esc_attr($alt_text) . '"';
        }
        $html .= ' />';

        return $html;
    } else {
        $html = "<img data-src='" . get_bloginfo("template_directory") . "/img/no-image.jpg' class='lozad' width='100px' height='100px' alt='" . get_wp_title_rss('') . " '/>";
        return $html;
    }
}

function custom_lozad_image($attachment_id, $size = 'full', $showEmptyImage = false)
{
    if (is_array($attachment_id))
        $attachment_id = $attachment_id["ID"];
    $image_attributes = wp_get_attachment_image_src($attachment_id, $size);
    $alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
    if ($image_attributes) {
        $html = "<img width='" . $image_attributes[1] . "' height='" . $image_attributes[2] . "' data-src='" . esc_url($image_attributes[0]) . "' class='lozad'";
        if (empty($alt_text)) {
            $html .= 'alt="' . get_wp_title_rss('') . '"';
        } else {
            $html .= ' alt="' . esc_attr($alt_text) . '"';
        }
        $html .= ' />';
    } else if (
        !$image_attributes && $showEmptyImage
    ) {
        $html = "<img width='100' height='100' alt='" . esc_attr(get_wp_title_rss('')) . "' data-src='" . get_bloginfo("template_directory") . "/img/no-image.jpg' class='lozad'";
        $html .= ' />';
    }
    return $html;
}

// Remove p tag in contact form 
add_filter('wpcf7_autop_or_not', '__return_false');

add_filter('rank_math/frontend/breadcrumb/items', function ($crumbs, $class) {
    $language_active = do_shortcode('[language]');
    $homepage_url = get_home_url();
    if ($language_active == 'en') {
        $crumbs[0][0] = 'Home';
        $crumbs[0][1] = $homepage_url;
    } else {
        $crumbs[0][0] = 'Trang chủ';
        $crumbs[0][1] = $homepage_url;
    }
    return $crumbs;
}, 10, 2);


// Lấy ID các trang sử dụng giao diện
function get_page_by_template($name_template)
{
    $pages = get_posts(array(
        'post_type' => 'page',
        'meta_key' => '_wp_page_template',
        'meta_value' => $name_template
    ));
    $id = $pages[0]->ID;
    return $id;
}



function dateFormatOnLayout($id_or_date)
{
    if (is_numeric($id_or_date)) {
        $id = (int)$id_or_date; // Ensure it's an integer (post ID)
        $day = get_the_date("d", $id);
        $month = get_the_date("m", $id);
        $year = get_the_date("Y", $id);
    } else {
        $date_time = false;

        // Array of possible date formats to check
        $date_formats = array("d/m/Y", "Y/d/m");
        // Try each date format until one succeeds
        foreach ($date_formats as $format) {
            $date_time = DateTime::createFromFormat($format, $id_or_date);
            if ($date_time !== false) {
                break; // Break out of the loop if a valid date is found
            }
        }
        if ($date_time) {
            $day = $date_time->format('d');
            $month = $date_time->format('m');
            $year = $date_time->format('Y');
        } else {
            // Handle invalid date string
            return __("Đang cập nhật...", 'canhcamtheme');
        }
    }
    $language_active = do_shortcode('[language]');
    // $dateFormat = get_the_time('H:i', $id) . ' - ' . $day . '/' . $month . '/' . $year;
    if ($language_active == 'vi') {
        $dateFormat = $day . '.' . $month . '.' . $year;
    } else {
        $dateFormat = $month . '.' . $day . '.' . $year;
    }
    return $dateFormat;
}

function getYear($time)
{
    // 
    if (!date_create($time))
        return __('Vui lòng nhập đúng định dạng ngày', 'canhcamtheme');
    $year = date_format(date_create($time), 'Y');
    return $year;
}

function fullDateLayout($date_string)
{
    $date_time = DateTime::createFromFormat("Y-m-d\TH:i:sT", $date_string);

    if (!$date_time) {
        return ''; // Return empty string if the date format is invalid
    }

    $language_active = do_shortcode('[language]');

    if ($language_active == 'vi') {
        $day_names = array(
            'Sunday' => 'Chủ nhật',
            'Monday' => 'Thứ hai',
            'Tuesday' => 'Thứ ba',
            'Wednesday' => 'Thứ tư',
            'Thursday' => 'Thứ năm',
            'Friday' => 'Thứ sáu',
            'Saturday' => 'Thứ bảy',
        );

        $dateFormat = $date_time->format("l, d/m/Y - G:i");
        $dateFormat = strtr($dateFormat, $day_names);
    } else {
        $dateFormat = $date_time->format("l, F/d/Y - G:i");
    }

    return $dateFormat;
}

function get_other_post_type($post, $catID, $post_per_page = 8)
{
    $args = array(
        'posts_per_page' => $post_per_page,
        'order_by' => "date",
        'post_type' => $post->post_type,
        'post__not_in' => array($post->ID),

    );
    if ($post->post_type != 'post') {
        // Get taxonomy by post id
        $taxonomy = get_post_taxonomies($post)[0];
        $term = wp_get_post_terms($post->ID, $taxonomy);
        $taxonomyID = $term[0]->term_taxonomy_id;
        $args['tax_query'] = array(
            'relation' => 'AND',
            array(
                'taxonomy' => $taxonomy,
                'field' => 'term_id',
                'terms' => array($taxonomyID),
            ),
        );
    } else {
        $args['category__in'] = $catID;
    }
    return $args;
}


// * get related post without tax query taxonomy 
function get_dynamic_related_posts($post, $posts_per_page = 8)
{
    $taxonomy = get_post_taxonomies($post)[0];
    $term = wp_get_post_terms($post->ID, $taxonomy)[0];
    $taxonomyID = $term->term_taxonomy_id;
    $args = array(
        'posts_per_page' => $posts_per_page,
        'order_by' => "date",
        'post_type' => $post->post_type,
        'post__not_in' => array($post->ID),
    );
    if ($post->post_type != 'post') {
        $args['tax_query'] = array(
            'relation' => 'AND',
            array(
                'taxonomy' => $taxonomy,
                'field' => 'term_id',
                'terms' => array($taxonomyID),
            ),
        );
    } else {
        $args['cat'] = $taxonomyID;
    }
    return $args;
}

function get_query_posts($term, $posts_per_page = 10)
{
    $taxonomy = $term->taxonomy;
    $taxonomyID = $term->term_taxonomy_id;
    $post_type = get_taxonomy($term->taxonomy)->object_type[0];
    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => $posts_per_page,
    );
    if ($taxonomy === 'category') {
        $args['cat'] = $taxonomyID;
    } else {
        $args['tax_query'] = array(
            'relation' => 'AND', // You can change 'AND' to 'OR' if needed
            array(
                'taxonomy' => $taxonomy,
                'field'    => 'term_id',
                'terms'    => $taxonomyID,
            ),
        );
    }
    return new WP_Query($args); // Return the WP_Query object directly
}



class Custom_Walker_Nav_Menu extends Walker_Nav_Menu
{

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        static $count = 0;
        if ($depth == 0) {
            $count++;
            if ($count == 1) {
                // Thêm class active cho icon home nếu đang ở trang chủ
                $home_class = (is_front_page() || is_home()) ? ' class="active"' : '';
                var_dump($home_class);
                $output .= '<li' . $home_class . '><a href="' . esc_attr($item->url) . '"><i class="fa-solid fa-house"></i></a></li>';
                return;
            }
        }
        
        $isValidCustomUrl = $item->custom_data && $item->custom_data['url'] && $item->custom_data['isModify'];
        if ($isValidCustomUrl) {
            $item->url = $item->custom_data['url'];
        }
        
        $classes = array();
        if ($depth === 0) {
            $classes[] = 'nav-link';
        } else {
            $classes[] = 'nav-link-sub';
        }

        // Kiểm tra active cho các trường hợp khác nhau
        $is_active = false;
        
        // Kiểm tra trang chủ
        if ((is_front_page() || is_home()) && ($item->object_id == get_option('page_on_front'))) {
            $is_active = true;
        }
        
        // Kiểm tra single post/page
        elseif (is_singular() && $item->object_id == get_the_ID()) {
            $is_active = true;
        }
        
        // Kiểm tra parent của current post
        elseif (is_singular() && in_array($item->object_id, get_post_ancestors(get_the_ID()))) {
            $is_active = true;
        }
        
        // Kiểm tra taxonomy
        elseif (is_tax() || is_category() || is_tag()) {
            $queried_object = get_queried_object();
            if ($queried_object && isset($queried_object->term_id) && $item->object_id == $queried_object->term_id) {
                $is_active = true;
            }
        }
        
        // Kiểm tra post type archive
        elseif (is_post_type_archive() && $item->object == get_post_type()) {
            $is_active = true;
        }
        
        // Fallback: sử dụng WordPress built-in classes
        elseif ($item->current || $item->current_item_ancestor || $item->current_item_parent) {
            $is_active = true;
        }
        
        if ($is_active) {
            $classes[] = 'active';
        }

        if (in_array('menu-item-has-children', $item->classes)) {
            $classes[] = 'drop-down';
        }

        $class_names = join(' ', array_filter($classes)); // array_filter để loại bỏ empty strings
        if ($item->classes) {
            $class_names .= ' ' . implode(' ', $item->classes);
        }

        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= '<li' . $class_names . '>';
        
        $attributes  = !empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target)     ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url)        ? ' href="'   . esc_attr($item->url) . '"' : '';
        
        $item_output = $args->before;
        if (in_array('menu-item-has-children', $item->classes)) {
            $item_output .= '<div class="title"><a' . $attributes . '>' . apply_filters('the_title', $item->title, $item->ID) . '</a><div class="icon"><i class="fa-thin fa-chevron-down"></i></div></div>';
        } else {
            $item_output .= '<a' . $attributes . '>' . apply_filters('the_title', $item->title, $item->ID) . '</a>';
        }
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        if ($depth === 0) {
            $output .= "\n$indent<ul class='nav-sub'>\n";
        } else {
            $output .= "\n$indent<ul>\n";
        }
    }
}

function wp_custom_link($items)
{
    $children = [];

    foreach ($items as $item) {
        if ($item->menu_item_parent && $item->menu_item_parent > 0 && $item->type_label === 'Custom Link') {
            array_push($children, [
                'name' => $item->post_title,
                'ID' => $item->ID,
                'parent_ID' => $item->menu_item_parent,
                'url' => '',
                'isModify' => false,
            ]);
        }
    }
    $newChildren = [];
    foreach ($children as $child) {
        foreach ($items as $item) {
            if ($item->ID == $child['parent_ID']) {
                // log_dump(sanitize_title($child['name']));
                // log_dump($child['name']);
                $child['url'] = $item->url . '#' . sanitize_title($child['name']);
                $child['isModify'] = true;
                $newChildren[] = $child;
            }
        }
    }
    foreach ($newChildren as $newChild) {
        foreach ($items as $item) {
            if ($item->ID == $newChild['ID']) {
                // log_dump($item->post_name);
                $item->custom_data = $newChild;
                $item->classes[] = 'dynamic-custom-link';
            }
        }
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'wp_custom_link');


function convert_iso($isoString)
{
    $dateTime = new DateTime($isoString);
    return $dateTime->format('Y-m-d');
}


function get_id_translate($templatePath, $postType = 'page')
{
    // templates/Ranking.php
    $pageTemplateID = get_page_by_template($templatePath);
    $pageTranslateID = get_id_language($pageTemplateID, $postType);
    return $pageTranslateID;
}


function compareArrays($array1, $array2)
{
    if (count($array1) !== count($array2)) {
        return false;
    }
    // Sort the arrays by their unique hashes
    usort($array1, function ($a, $b) {
        return strcmp(sha1(json_encode($a)), sha1(json_encode($b)));
    });

    usort($array2, function ($a, $b) {
        return strcmp(sha1(json_encode($a)), sha1(json_encode($b)));
    });

    // Iterate through the arrays and compare the hashes
    for ($i = 0; $i < count($array1); $i++) {
        if (sha1(json_encode($array1[$i])) !== sha1(json_encode($array2[$i]))) {
            return false; // Objects do not match
        }
    }

    return true; // Arrays are the same
}


function get_random_posts($categoryID, $length = 5)
{
    // Define your custom query to get random posts
    $args = array(
        'post_type' => 'post', // Change 'post' to your desired post type
        'posts_per_page' => $length,
        'post_status' => array(
            'publish',
        ),
        'cat' => $categoryID,
    );

    $random_query = new WP_Query($args);

    // Check if there are posts
    if ($random_query->have_posts()) {
        $random_posts = $random_query->posts;
    } else {
        $random_posts = array(); // No posts found
    }

    // Restore the original post data
    wp_reset_postdata();

    return $random_posts;
}


function autoRenderHref($value)
{
    if (is_object($value)) {
        if ($value->post_type) {
            return get_permalink($value->ID);
        }
    }
    if (is_string($value)) {
        return $value;
    }

    if (is_numeric($value)) {
        $isTaxLink = get_term_link($value);
        if (!is_wp_error($isTaxLink))
            return $isTaxLink;
        else {
            $isPostLink = get_permalink($value);
            if ($isPostLink) return $isPostLink;
        }
    } else {
        return;
    }
}


function getImageUrl($imageID)
{
    if (is_array($imageID))
        $imageID = $imageID["ID"];
    $image_url = wp_get_attachment_image_url($imageID, 'full');
    return $image_url;
}


add_filter('rank_math/frontend/breadcrumb/items', function ($crumbs, $class) {
    if (is_singular('product') || is_singular('post')) {
        array_pop($crumbs);
    }
    return $crumbs;
}, 10, 2);

// AJAX Load More Recruitment Posts
function load_more_recruitment_posts() {
    $page = intval($_POST['page']);
    $posts_per_page = intval($_POST['posts_per_page']);
    $offset = intval($_POST['offset']);

    $args = array(
        'post_type' => 'recruitment',
        'posts_per_page' => $posts_per_page,
        'offset' => $offset,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    );

    $recruitment_query = new WP_Query($args);
    $html = '';
    $count = $offset + 1;

    if ($recruitment_query->have_posts()) {
        ob_start();
        while ($recruitment_query->have_posts()): $recruitment_query->the_post();
            $recruitment_id = get_the_ID();
            $area = get_field('area', $recruitment_id) ?: '';
            $deadline = get_field('deadline', $recruitment_id) ?: '';
            ?>
<tr>
    <td class="text-center p-3"><?= str_pad($count, 2, '0', STR_PAD_LEFT) ?></td>
    <td>
        <a class="recruitment-link" href="<?= get_permalink() ?>"><?= get_the_title() ?></a>
    </td>
    <td class="text-center"><?= esc_html($area) ?></td>
    <td class="text-center"><?= esc_html($deadline) ?></td>
    <td class="text-center text-Primary-New-1">
        <div class="dowload flex items-center gap-3 justify-center">
            <a class="font-medium" href="<?= get_permalink() ?>"><?= __('Xem thêm', 'canhcamtheme') ?></a>
            <i class="fa-solid fa-arrow-right"></i>
        </div>
    </td>
</tr>
<?php
            $count++;
        endwhile;
        wp_reset_postdata();
        $html = ob_get_clean();
    }

    $has_more = ($offset + $posts_per_page) < $recruitment_query->found_posts;

    wp_send_json_success(array(
        'html' => $html,
        'has_more' => $has_more
    ));
}
add_action('wp_ajax_load_more_recruitment', 'load_more_recruitment_posts');
add_action('wp_ajax_nopriv_load_more_recruitment', 'load_more_recruitment_posts');



function custom_rank_math_breadcrumb_items( $crumbs, $class ) {
    
    if ( count( $crumbs ) > 2 ) {
        
        $new_crumbs = [];
        
        $new_crumbs[] = $crumbs[0];
        
        $cpt_archive_link = get_post_type_archive_link( 'product' );
        
        if ( is_singular( 'product' ) && $cpt_archive_link ) {
             $new_crumbs[] = [ 
                esc_html__( 'Sản phẩm', 'canhcamtheme' ),
                $cpt_archive_link,
            ];
        }
        
        $last_item = end( $crumbs );
        $new_crumbs[] = $last_item;
        
        return $new_crumbs;

    }
    
    return $crumbs;
}
add_filter( 'rank_math/frontend/breadcrumb/items', 'custom_rank_math_breadcrumb_items', 10, 2 );