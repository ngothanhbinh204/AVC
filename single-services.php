<?php get_header(); ?>

<?php
get_template_part('./modules/banner/page-banner');
get_template_part('./modules/breadcrumb/breadcrumb');
?>

<?php
global $post;
$taxonomy = get_post_taxonomies($post);
$term = wp_get_post_terms($post->ID, $taxonomy);
$taxonomyID = $term[0]->term_taxonomy_id;
$the_query = new WP_query(get_other_post_type($post, $term[0]->term_taxonomy_id, 5));
?>

<?php
get_template_part('/components/services/single/services-detail-1');
get_template_part('/components/services/single/services-detail-2');
get_template_part('/components/services/single/services-detail-3');
get_template_part('/components/services/single/services-detail-4');
get_template_part('/components/services/single/services-detail-5');
get_template_part('/components/services/single/services-detail-6');
// 
get_template_part("/components/share-layout/section-form-advise", null, array(
    'openWrapper' => '<section class="introduce-6 xl:py-10 bg-[#EAF5FF]">',
    'closeWrapper' => '</section>',
));
// 
get_template_part('/components/services/single/services-detail-7');
?>







<?php get_footer(); ?>