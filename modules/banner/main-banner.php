<?php
$id_category = get_queried_object()->term_id;
$taxonomy = get_queried_object()->taxonomy;
if ($id_category) {
    $id = $taxonomy . '_' . $id_category;
} else {
    $id = get_the_ID();
}
$banners = get_field('banner_select_page', $id);
$current_page_ID = get_the_ID()
?>


<?php if ($banners) : ?>
    <section class="home-1 overflow-hidden" id="main-banner">
        <div class="swiper">
            <div class="swiper-wrapper">

                <?php foreach ($banners as $banner) : ?>
                    <?php $video = get_field('video', $banner);; ?>
                    <div class="swiper-slide relative">
                        <?php if ($video) : ?>
                            <div class="play-btn">
                                <div class="icon image-svg image-absolute absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-2">
                                    <a href="javascript:;"> <img class="lozad" data-src="./img/icon/play.svg" /></a>
                                </div>
                            </div>
                            <div class="video absolute inset-0 z-1 pointer-events-none">
                                <video data-src="<?= $video ?>" muted playsinline preload="none"></video>
                            </div>
                        <?php endif; ?>
                        <div class="img"><a href="javascript:;" rel="nofollow"><?= custom_get_post_thumbnail($banner) ?></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>