<?php
global $post;
$fields = get_field('group_6', $post);
$select_category = $fields['select_category'];
?>
<?php if ($select_category) : ?>
    <?php
    $post_type = get_taxonomy($select_category->taxonomy)->object_type[0];
    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => 12,
        'cat' => $select_category->term_id,
    );
    $the_query = new WP_Query($args);
    ?>
    <?php if ($the_query->have_posts()) : ?>
        <section class="home-6 section pb-0 xl:pt-20">
            <div class="container">
                <div data-aos="zoom-in-up">
                    <h2 class="block-title text-center"><?= $fields['title'] ?></h2>
                </div>
                <div data-aos="zoom-in-down" data-aos-delay=400>
                    <div class="list mt-10">
                        <div class="swiper-shadow-spacing swiper-column-auto auto-4-column relative auto-play allow-touchMove">
                            <div class="swiper">
                                <div class="swiper-wrapper">

                                    <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                            <div class="swiper-slide">
                                                <?= get_template_part('/components/boxNews/boxNews-1', null, array(
                                                    'id' => get_the_ID(),
                                                    'wrapTag' => 'h3'
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
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>