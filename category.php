<?php get_header(); ?>

<?php
$terms = get_queried_object();
$taxonomy = $terms->taxonomy;
$current_parent = $terms->parent;
$taxonomyID = $terms->term_taxonomy_id;
$acf_key = $taxonomy . '_' . $taxonomyID;
$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
$post_type = get_taxonomy($taxonomy)->object_type[0];
$depthParentID = get_term_depth($taxonomy, 0);
$has_child = get_terms(array(
    'taxonomy'  => $taxonomy,
    'hide_empty' => false,
    'parent' => $depthParentID,
));
$parent_term = get_term($depthParentID, $taxonomy);
$posts_per_page = 10;
?>

<?php
get_template_part('./modules/banner/page-banner');
?>

<?php $args = array(
    'post_type' => $post_type,
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
    'cat' => $taxonomyID,
);
$the_query = new WP_Query($args);
?>


<section class="news-list section xl:py-20">
    <div class="container">
        <h1 class="block-title text-center">
            <?= $parent_term->name ?>
        </h1>
        <?php if ($has_child) : ?>
            <div class="normal-nav auto-scroll-nav xl:mt-10 mt-6">
                <nav class="justify-center flex items-center">
                    <ul>
                        <?php foreach ($has_child as $value) : ?>
                            <li <?php if ($taxonomyID === $value->term_id) : ?>class="active" <?php endif; ?>>
                                <a href="<?= get_term_link($value->term_id) ?>">
                                    <?= $value->name ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            </div>
        <?php endif; ?>
        <div class="list grid-cols-2 lg:grid-cols-4 grid gap-x-3 gap-y-4 sm:gap-4 xl:gap-10 xl:mt-10 mt-6">
            <?php $key = 0; ?>
            <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <?php $key++; ?>
                    <?php if ($key === 1 || $key === 2) : ?>
                        <div class="big col-span-1 lg:col-span-2">
                            <?= get_template_part('/components/boxNews/boxNews-1', null, array(
                                'id' => get_the_ID()
                            )) ?>
                        </div>
                    <?php else : ?>
                        <?= get_template_part('/components/boxNews/boxNews-1', null, array(
                            'id' => get_the_ID()
                        )) ?>
                    <?php endif; ?>

            <?php endwhile;
            endif;
            wp_reset_postdata(); ?>
        </div>
        <?= wp_bootstrap_pagination(array("custom_query" => $the_query)) ?>
    </div>
</section>

<?php get_footer(); ?>