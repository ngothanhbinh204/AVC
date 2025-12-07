<?php
function get_product_item_callback()
{
    $taxonomyID = $_POST['taxonomyID'];
    $taxonomy = $_POST['taxonomy'];
    $paged = 1;
    $posts_per_page = -1;
    $post_type = $_POST['post_type'];
    $postTemplate = $_POST['postTemplate'];

    $default_query =  array(
        'taxonomy' => $taxonomy,
        'field' => 'term_id',
        'terms' => array($taxonomyID),
    );
    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => $posts_per_page,
        // 'post_status' => "publish",
        // 'order' => 'DESC',
        // 'orderby' => 'date',
        'paged' => $paged,
        'tax_query' => array(
            'relation' => 'AND',
            $default_query,
        ),
    );
    $the_query = new WP_Query($args);

    $response = '';
    if ($the_query->have_posts()) {
        ob_start();
        while ($the_query->have_posts()) : $the_query->the_post();
            $response .= get_template_part($postTemplate, null, array(
                'id' => get_the_ID(),
            ));
        endwhile;
        $html = ob_get_contents();
        ob_end_clean();
    }


    $result = [
        'html' => $html,
    ];

    echo json_encode($result);
    exit;
}
add_action('wp_ajax_get_product_item_callback', 'get_product_item_callback');
add_action('wp_ajax_nopriv_get_product_item_callback', 'get_product_item_callback');



function weichie_dynamic_load_more()
{
    $postType = $_POST['postType'];
    if ($_POST['posts_per_page'])
        $posts_per_page = $_POST['posts_per_page'];

    $termID = $_POST['termID'];

    $the_query = new WP_Query([
        'post_type' => $postType,
        'posts_per_page' => $posts_per_page,
        'paged' => $_POST['paged'],
        'orderby' => "menu_order",
        'post_parent' => $_POST['parentPageID'],
    ]);
    $response = '';
    $max_pages = $the_query->max_num_pages;

    $template = $_POST['template'];

    if ($the_query->have_posts()) {
        ob_start();
        while ($the_query->have_posts()) : $the_query->the_post();
            $response .= get_template_part($template, null, array('id' => get_the_ID()));
        endwhile;
        $output = ob_get_contents();
        ob_end_clean();
    } else {
        $response = '';
    }
    $result = [
        'html' => $output,
        'max' => $max_pages,
    ];

    echo json_encode($result);

    // echo $response;
    exit;
}
add_action('wp_ajax_weichie_dynamic_load_more', 'weichie_dynamic_load_more');
add_action('wp_ajax_nopriv_weichie_dynamic_load_more', 'weichie_dynamic_load_more');
