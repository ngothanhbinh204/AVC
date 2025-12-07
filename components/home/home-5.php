<?php
global $post;
$fields = get_field('group_5', $post);
$repeater = $fields['repeater'];
$videos = $fields['videos'];
?>
<section class="home-5 section xl:pt-26 pb-0">
    <div class="container">
        <div data-aos="flip-up">
            <h2 class="block-title text-center"><?= $fields['title'] ?></h2>
        </div>
        <?php if ($repeater) : ?>
            <div class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-x-10px gap-y-8 section md:pb-10">
                <?php $key = 0; ?>
                <?php foreach ($repeater as $value) : ?>
                    <?php $key++; ?>
                    <div class="h-full" data-aos="fade-left" data-aos-delay='<?= $key ?>00'>
                        <div class="item h-full relative py-8 px-3 lg:px-9 flex items-center justify-center" setbackground="<?php bloginfo("template_directory"); ?>/img/home/h-5-i-bg.webp">
                            <div class="icon absolute rounded-full border-3 border-[#BE9156] w-50px xl:w-70px h-50px xl:h-70px flex items-center justify-center bg-white -translate-y-1/2 top-0 left-3 xl:left-30px overflow-hidden p-2 sm:p-3">
                                <a href="javascript:;" rel="nofollow"><?= custom_lozad_image($value['icon']) ?></a>
                            </div>
                            <h3 class="label subheader-24 font-bold text-[#BE9156] text-center"><?= $value['title'] ?></h3>
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
                                <div class="swiper-slide relative <?php if ($video) : ?> has-youtube-video <?php endif; ?>" <?php if ($video) : ?>data-embed="<?= $video ?>" <?php endif; ?>>
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
                                    <div class="wrapper absolute bottom-0 max-w-[calc(1280/1400*100%)] left-1/2 -translate-x-1/2 w-full z-1 bg-primary-800/90 rounded-t-3">
                                        <div class="title text-20px lg:subheader-24 font-bold text-white text-center py-3 lg:py-30px px-4">
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