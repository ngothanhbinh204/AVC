<?php
// File: components/home/home-1.php
// Banner section - Using existing banner_select_page ACF field
global $post;
$banners = get_field('banner_select_page', $post->ID);
?>
<?php if ($banners) : ?>
    <section class="home-1 overflow-hidden" id="main-banner" data-aos="fade-in">
        <div class="swiper relative">
            <div class="swiper-wrapper">
                <?php foreach ($banners as $banner) : ?>
                    <?php
                    $video = get_field('video', $banner);
                    $mobile_image = get_field('mobile_image', $banner);
                    $url = get_field('url', $banner);
                    if ($video) {
                        $url = 'javascript:;';
                    }
                    ?>
                    <div class="swiper-slide relative">
                        <?php if ($video) : ?>
                            <div class="play-btn">
                                <div class="icon image-svg image-absolute absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-2">
                                    <a href="javascript:;"><img class="lozad" data-src="<?php bloginfo("template_directory"); ?>/img/icon/play.svg"/></a>
                                </div>
                            </div>
                            <div class="video absolute inset-0 z-1 pointer-events-none">
                                <video data-src="<?= $video ?>" muted playsinline preload="none"></video>
                            </div>
                        <?php endif; ?>
                        <div class="img">
                            <?php if ($mobile_image) : ?>
                                <div class="md:block hidden">
                                    <a href="<?= $url ?? 'javascript:;' ?>" rel="nofollow">
                                        <?= custom_get_post_thumbnail($banner) ?>
                                    </a>
                                </div>
                                <div class="md:hidden">
                                    <a href="<?= $url ?? 'javascript:;' ?>" rel="nofollow">
                                        <?= custom_lozad_image($mobile_image) ?>
                                    </a>
                                </div>
                            <?php else : ?>
                                <a href="<?= $url ?? 'javascript:;' ?>" rel="nofollow">
                                    <?= custom_get_post_thumbnail($banner) ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="arrow-button"> 
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </section>
<?php endif; ?>
