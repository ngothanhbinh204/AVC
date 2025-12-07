<?php
global $post;
$fields = get_field('group_7', $post);
?>
<section class="home-7 section xl:pt-20 pb-5">
    <div class="container">
        <div class="max-w-clamp-1314px mx-auto">
            <div data-aos="zoom-out-up">
                <h2 class="title text-40px md:text-60px xl:text-80px leading-normal font-black text-image text-center">
                    <?= $fields['title'] ?>
                </h2>
            </div>
        </div>
        <div data-aos="zoom-out-up" data-aos-delay=300>
            <h3 class="description mt-5 text-18px font-normal text-neutral-900 text-center max-w-clamp-1165px mx-auto"><?= $fields['description'] ?></h3>
        </div>
        <?php $file = $fields['file']; ?>
        <?php if ($file) : ?>
            <div data-aos="fade-left" data-aos-delay=500>
                <a class="download-catalogue flex flex-col justify-center items-center text-primary-800 text-18px font-bold gap-1 image-svg xl:mt-10 mt-8" href="<?= $file ?>" target="_blank">
                    <img class="lozad" data-src="<?php bloginfo("template_directory"); ?>/img/home/download.svg">
                    <?php _e('Tải Catalogue', 'canhcamtheme'); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>