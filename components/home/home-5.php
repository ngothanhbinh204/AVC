<?php
// File: components/home/home-5.php
// Section: Tại sao chọn chúng tôi
global $post;

$fields = get_field('group_5', $post->ID);
$title = $fields['title'] ?? '';
$items = $fields['items'] ?? [];
$videos = $fields['videos'];

?>
<section class="home-5 section xl:pt-26 pb-0" data-aos="fade-up" data-aos-delay="300">
    <div class="container">
        <?php if ($title) : ?>
        <h2 class="block-title text-center mb-5"><?= $title ?></h2>
        <?php endif; ?>
        <?php if ($items) : ?>
        <div class="wrapper grid md:grid-cols-2 grid-cols-1 gap-10 mb-10">
            <?php foreach ($items as $item) : ?>
            <?php
                    $item_image = $item['item_image'] ?? '';
                    $item_title = $item['item_title'] ?? '';
                    $item_description = $item['item_description'] ?? '';
                    $item_link = $item['item_link'] ?? '';
                    $link_url = $item_link['url'] ?? 'javascript:;';
                    ?>
            <div class="item-service-primary overflow-hidden">
                <?php if ($item_image) : ?>
                <a class="img img-ratio ratio:pt-[463_680]" href="<?= $link_url ?>">
                    <?= get_image_attrachment($item_image, 'image') ?>
                </a>
                <?php endif; ?>
                <div class="content absolute bottom-0 left-0 w-full wrap-item-height md:p-6 p-3 text-white z-20">
                    <?php if ($item_title) : ?>
                    <h3 class="title rem:text-[24px] font-normal mb-5"><?= $item_title ?></h3>
                    <?php endif; ?>
                    <?php if ($item_description) : ?>
                    <div class="desc item-var-height pt-5 border-t border-t-white/50">
                        <div class="content-desc">
                            <?= $item_description ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if ($videos) : ?>
        <div data-aos="fade-up">
            <div class="swiper-column-auto allow-touchMove">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($videos as $value) : ?>
                        <?php
                                $video = $value['video'];
                                $image = $value['image'];
                                $title = $value['title'];
                                ?>
                        <div class="swiper-slide relative <?php if ($video) : ?> has-youtube-video <?php endif; ?>"
                            <?php if ($video) : ?>data-embed="<?= $video ?>" <?php endif; ?>>
                            <?php if ($video) : ?>
                            <div class="video-toggle">
                                <div class="play-btn">
                                    <div
                                        class="icon image-svg image-absolute absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-2">
                                        <a href="javascript:;"> <img class="lozad"
                                                data-src="<?php bloginfo("template_directory"); ?>/img/icon/play.svg" /></a>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="img">
                                <a href="javascript:;" rel="nofollow"><?= custom_lozad_image($image) ?></a>
                            </div>
                            <div
                                class="wrapper absolute bottom-0 max-w-[calc(1280/1400*100%)] left-1/2 -translate-x-1/2 w-full z-1 bg-primary-800/90 rounded-t-3">
                                <div
                                    class="title text-20px lg:subheader-24 font-bold text-white text-center py-3 lg:py-30px px-4">
                                    <h4><?= $title ?></h4>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>