<?php get_header(); ?>

<?php
get_template_part('./modules/banner/page-banner');
?>

<?php
global $post;
$taxonomy = get_post_taxonomies($post);
$term = wp_get_post_terms($post->ID, $taxonomy);
$taxonomyID = $term[0]->term_taxonomy_id;
$the_query = new WP_query(get_other_post_type($post, $term[0]->term_taxonomy_id, 5));

$product_options = get_field('product_options', 'options');
$form_shortcode = $product_options['form_shortcode'];
?>

<section class="product-detail-1 section xl:py-20">
    <div class="container">
        <div class="grid lg:grid-cols-2 gap-6 xl:gap-10">
            <div class="col-left">
                <?php $main_image = custom_lozad_image(get_field('image_detail', $post)) ?? custom_get_post_thumbnail($post); ?>
                <div class="img">
                    <a href="javascript:;" rel="nofollow">
                        <?= $main_image ?>
                    </a>
                </div>
            </div>
            <div class="col-right">
                <div class="wrapper space-y-3">
                    <h1 class="title header-32 font-bold"><?= the_title() ?></h1>
                    <!-- <?php if (get_the_excerpt($post)) : ?>
                        <div class="sub-title text-18px font-bold text-neutral-900">
                            <?= the_excerpt() ?>
                        </div>
                    <?php endif; ?> -->
                    <div class="description text-18px font-normal text-neutral-900 space-y-5 primary-list-color"><?= the_content() ?></div>
                    <?php if ($form_shortcode) : ?>
                        <div class="button">
                            <a class="btn btn-primary phone-icon mt-8" data-fancybox data-popup="popup-product-form" data-src="#popup-product-form" data-close-normal>
                                <?php _e('LIÊN HỆ TƯ VẤN', 'canhcamtheme'); ?>
                            </a>
                        </div>
                        <?php $image_popup = custom_lozad_image(get_field('image_popup', $post)) ?? custom_get_post_thumbnail($post); ?>
                        <div class="hidden">
                            <div id="popup-product-form">
                                <div class="wrapper flex lg:flex-row flex-col">
                                    <div class="col-left w-full lg:block hidden">
                                        <div class="img">
                                            <a>
                                                <?= $image_popup ?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-right w-full flex-1">
                                        <div class="space-y-5">
                                            <div class="title header-32 font-bold">
                                                <?= the_title() ?>
                                            </div>
                                            <div class="description text-18px text-neutral-900"><?= $product_options['description'] ?></div>
                                            <?= do_shortcode($form_shortcode) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $group_2 = get_field('group_2', $post);
$gallery = $group_2['gallery'];
?>
<?php if ($group_2['title'] || $group_2['gallery']) : ?>
    <section class="product-detail-2 section bg-[#ECFDF7] xl:py-20">
        <div class="container">
            <div class="grid grid-cols-2 gap-6 xl:gap-10">
                <div class="col-left col-span-full lg:col-span-1 lg:pt-10 xl:pt-21">
                    <div class="wrapper lg:max-w-clamp-573px">
                        <div class="title header-32 font-bold">
                            <?= $group_2['title'] ?>
                        </div>
                        <div class="description text-18px text-neutral-900 mt-3"><?= $group_2['description'] ?></div>
                    </div>
                </div>
                <?php if ($gallery) : ?>
                    <div class="col-right col-span-full lg:col-span-1">
                        <div class="main">
                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    <?php foreach ($gallery as $value) : ?>
                                        <div class="swiper-slide">
                                            <div class="img"><a href="javascript:;" rel="nofollow"><?= custom_lozad_image($value) ?></a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="thumb mt-5 xl:px-10">
                            <div class="relative">
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($gallery as $value) : ?>
                                            <div class="swiper-slide">
                                                <div class="img"><a href="javascript:;" rel="nofollow"><?= custom_lozad_image($value) ?></a>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="arrow-button">
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if ($the_query->have_posts()) : ?>
    <section class="product-detail-3 section xl:py-20">
        <div class="container">
            <div class="title header-32 font-bold text-primary-800 text-center">
                <?php _e('Sản phẩm liên quan', 'canhcamtheme'); ?>
            </div>
            <div class="list mt-10">
                <div class="swiper-shadow-spacing swiper-column-auto auto-4-column relative auto-play allow-touchMove">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                    <div class="swiper-slide">
                                        <?php $id = get_the_ID(); ?>
                                        <?= get_template_part('/components/boxProduct/boxProduct-1', null, array(
                                            'id' => $id,
                                        )) ?>
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
        </div>
    </section>
<?php endif; ?>


<?php get_footer(); ?>


<script>
    window.addEventListener('load', function() {
        const target = $("#popup-product-form");
        if (!target.length) return;
        target.find("input[name='productName']").val("<?= get_the_title($post) ?>");
        target.find("input[name='productUrl']").val("<?= get_permalink($post) ?>");
    })
</script>