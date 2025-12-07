<?php
/*
global $post;
$banners = get_field('banner_select_page', $id);
?>
<?php if ($banners) : ?>
    <section class="home-1 overflow-hidden" data-aos="fade-down" id="main-banner">
        <div class="swiper">
            <div class="swiper-wrapper">
                <?php foreach ($banners as $banner) : ?>
                    <?php
                    $video = get_field('video', $banner);
                    $mobile_image = get_field('mobile_image', $banner);
                    ?>
                    <div class="swiper-slide relative">
                        <?php if ($video) : ?>
                            <div class="play-btn">
                                <div class="icon image-svg image-absolute absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-2">
                                    <a href="javascript:;"> <img class="lozad" data-src="<?php bloginfo("template_directory"); ?>/img/icon/play.svg" /></a>
                                </div>
                            </div>
                            <div class="video absolute inset-0 z-1 pointer-events-none">
                                <video data-src="<?= $video ?>" muted playsinline preload="none"></video>
                            </div>
                        <?php endif; ?>
                        <div class="img">
                            <?php
                            $url = get_field('url', $banner);
                            if ($video) {
                                $url = 'javascript:;';
                            }
                            ?>
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
        </div>
    </section>
<?php endif; ?>
*/
?>
<?php
global $post;
$banners = get_field('banner_select_page', $id);
?>
<?php if ($banners) : ?>
    <section class="home-1 overflow-hidden" data-aos="fade-down" id="main-banner">
        <div class="swiper">
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
                        <div class="img">
                            <?php if ($video) : ?>
                                <!-- Hiển thị video tự động phát trong div.md:block.hidden -->
                                <div class="md:block hidden">
                                    <a href="<?= $url ?>" rel="nofollow">
                                        <video data-src="<?= $video ?>" muted playsinline autoplay preload="auto"></video>
                                    </a>
                                </div>
                                <div class="md:hidden">
                                    <a href="<?= $url ?>" rel="nofollow">
                                        <?= custom_lozad_image($mobile_image) ?>
                                    </a>
                                </div>
                            <?php else : ?>
                                <!-- Hiển thị ảnh tĩnh khi không có video -->
                                <?php if ($mobile_image) : ?>
                                    <div class="md:block hidden">
                                        <a href="<?= $url ?>" rel="nofollow">
                                            <?= custom_get_post_thumbnail($banner) ?>
                                        </a>
                                    </div>
                                    <div class="md:hidden">
                                        <a href="<?= $url ?>" rel="nofollow">
                                            <?= custom_lozad_image($mobile_image) ?>
                                        </a>
                                    </div>
                                <?php else : ?>
                                    <a href="<?= $url ?>" rel="nofollow">
                                        <?= custom_get_post_thumbnail($banner) ?>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
