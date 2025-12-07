<?php get_header(); ?>

<?php
$terms = get_queried_object();
$taxonomy = $terms->taxonomy;
$taxonomyID = $terms->term_taxonomy_id;
?>

<?php
$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
$post_type = get_taxonomy($taxonomy)->object_type[0];
$acf_key = $taxonomy . '_' . $taxonomyID;
$posts_per_page = 6;
?>

<?php
get_template_part('./modules/banner/page-banner');
get_template_part('./modules/breadcrumb/breadcrumb');
?>

<?php
$default_query =  array(
    'taxonomy' => $taxonomy,
    'field' => 'term_id',
    'terms' => array($taxonomyID),
);
$args = array(
    'post_type' => $post_type,
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
    'tax_query' => array(
        'relation' => 'AND',
        $default_query,
    ),
);
$the_query = new WP_Query($args);
?>

<section class="pricing-1 section">
    <div class="container">
        <h1 class="block-title text-center"><?= $terms->name ?></h1>
        <div class="swiper-column-auto relative auto-4-column auto-play mt-6 xl:mt-8">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
                            <div class="swiper-slide">
                                <div class="item py-5 xl:py-8 px-4 xl:px-5">
                                    <?php
                                    $id = get_the_ID();
                                    $price = get_field('price', $id);
                                    $time = get_field('time', $id);
                                    $tag = get_field('tag', $id);
                                    $infos = get_field('infos', $id);
                                    ?>
                                    <div class="top">
                                        <div class="wrap-title flex items-center justify-between gap-3 flex-wrap">
                                            <h2 class="block title subheader-20 font-bold font-Montserrat"><?= get_the_title($id) ?></h2>
                                            <?php if ($tag) : ?>
                                                <div class="tag body-14 font-bold w-fit uppercase rounded-4px">
                                                    <?= $tag ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php if ($price) : ?>
                                            <div class="price header-32 font-bold font-Montserrat mt-5">
                                                <?= $price ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($time) : ?>
                                            <div class="time body-14 text-neutral-700 mt-1">
                                                <?= $time ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="middle">
                                        <?php if ($infos) : ?>
                                            <div class="infos">
                                                <?php foreach ($infos as $info) : ?>
                                                    <div class="info">
                                                        <div class="sub-title body-16 font-bold text-neutral-950"><?= $info['sub_title'] ?></div>
                                                        <?php $contents = $info['content']; ?>
                                                        <?php if ($contents) : ?>
                                                            <div class="content">
                                                                <?php foreach ($contents as $value) : ?>
                                                                    <div class="ctn"><?= $value['text'] ?></div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <?php $button = get_field('button_url', 'features-price-post'); ?>
                                    <?php if ($button) : ?>
                                        <div class="bottom">
                                            <?= get_template_part('/components/UI/button', null, array(
                                                'className' => 'mx-auto',
                                                'text' => __('Liên hệ tư vấn', 'canhcamtheme'),
                                                'href' => $button,
                                            )) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                    <?php endwhile;
                    endif;
                    wp_reset_postdata(); ?>
                </div>
            </div>
            <div class="arrow-button">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>
</section>

<?php
$features = get_field('features', 'features-price-post');
$select_post = $features['select_post'];
$trLength = count($select_post);
$comparison = $features['comparison'];
?>
<?php if ($select_post && $comparison) : ?>
    <section class="pricing-2 section pt-0 xl:pb-20">
        <div class="container">
            <h2 class="block-title text-center">
                <?php _e('SO SÁNH CÁC GÓI', 'canhcamtheme'); ?>
            </h2>
            <div class="table-information xl:mt-8 mt-6">
                <table>
                    <thead>
                        <tr>
                            <td class="column-left">Features</td>
                            <?php foreach ($select_post as $value) : setup_postdata($value); ?>
                                <?php $price = get_field('price', $value->ID);
                                $time = get_field('time', $value->ID); ?>
                                <td>
                                    <div class="title subheader-20 font-bold text-primary-1000 uppercase font-Montserrat"><?= get_the_title($value->ID) ?> <?= edit_link_post($id) ?></div>
                                    <div class="price text-xs leading-1.33 font-medium text-neutral-700 mt-5px"><?= $price . '/ ' . $time ?></div>
                                </td>
                            <?php endforeach;
                            wp_reset_postdata(); ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comparison as $value) : ?>
                            <tr>
                                <td class="column-left"><?= $value['title'] ?></td>
                                <?php $list = $value['list']; ?>
                                <?php if ($list) : ?>
                                    <?php $key = 0; ?>
                                    <?php foreach ($list as $sub_value) : ?>
                                        <?php $key++; ?>
                                        <?php
                                        $contentType = $sub_value['content_type'];
                                        $content = $contentType['content'];
                                        if (empty($content)) {
                                            $content = $contentType['check'];
                                            if ($content === false) {
                                                $content = '<div class="icon uncheck"><img src="' . get_bloginfo("template_directory") . '/img/pricing/uncheck.svg"></div>';
                                            } else {
                                                $content = '<div class="icon check"><img src="' . get_bloginfo("template_directory") . '/img/pricing/check.svg"></div>';
                                            }
                                        }
                                        ?>
                                        <?php if ($trLength >= $key) : ?>
                                            <td>
                                                <div class="description body-16 text-black"><?= $content ?></div>
                                            </td>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
            <div class="button"><a class="btn btn-primary btn-dropdown mx-auto mt-6 xl:mt-8">XEM THÊM</a></div>
        </div>
    </section>
<?php endif; ?>



<?php get_template_part('/components/share-layout/section-faqs', null, array(
    'openWrapper' => '<section class="pricing-3">',
    'closeWrapper' => '</section>',
)); ?>

<?php
get_template_part("/components/share-layout/section-form-advise");
?>


<?php get_footer(); ?>