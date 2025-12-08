<?php
// File: components/home/home-6.php
// Section: Tin tức nổi bật - Using Relationship field
global $post;

$fields = get_field('group_6', $post->ID);
$title = $fields['title'] ?? '';
$selected_posts = $fields['posts'] ?? [];
?>
<?php if ($selected_posts) : ?>
<section class="home-6 section pb-0 xl:pt-20" data-aos="fade-up" data-aos-delay="400">
    <div class="container">
        <?php if ($title) : ?>
        <h2 class="block-title text-center"><?= $title ?></h2>
        <?php endif; ?>
        <div class="list mt-10">
            <div class="swiper-shadow-spacing swiper-column-auto auto-4-column relative auto-play allow-touchMove">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($selected_posts as $post_id) : ?>
                        <?php
                                $post_obj = get_post($post_id);
                                if (!$post_obj) continue;
                                $post_title = $post_obj->post_title;
                                $post_date = get_the_date('d.m.Y', $post_id);
                                $post_link = get_permalink($post_id);
                                ?>
                        <div class="swiper-slide">
                            <div class="bn-1 h-full flex flex-col transition-all">
                                <div class="img">
                                    <a href="<?= $post_link ?>">
                                        <?= get_image_post($post_id, 'image') ?>
                                    </a>
                                </div>
                                <div class="content pt-5 px-2 sm:px-5 pb-3 flex-1 flex flex-col">
                                    <div
                                        class="title text-16px sm:subheader-24 font-bold text-black flex-1 transition-all">
                                        <a href="<?= $post_link ?>">
                                            <span class="line-clamp-4"><?= $post_title ?></span>
                                        </a>
                                    </div>
                                    <date class="text-18px text-neutral-500-main block mt-10"><?= $post_date ?></date>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="arrow-button">
                    <div style="background: url(wp-content/themes/canhcamtheme/img/btn-bg.svg) no-repeat 50%"
                        class="swiper-button-prev"></div>
                    <div style="background: url(wp-content/themes/canhcamtheme/img/btn-bg.svg) no-repeat 50%"
                        class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>