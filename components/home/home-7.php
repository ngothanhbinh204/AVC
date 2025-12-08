<?php
// File: components/home/home-7.php
// Section: Download Catalogue
global $post;

$fields = get_field('group_7', $post->ID);
$title = $fields['title'] ?? '';
$description = $fields['description'] ?? '';
$download_icon = $fields['download_icon'] ?? '';
$download_text = $fields['download_text'] ?? __('Tải Catalogue', 'canhcamtheme');
$download_file = $fields['file'] ?? '';
?>
<section class="home-7 section xl:pt-20 pb-5" data-aos="fade-up" data-aos-delay="500">
    <div class="container">
        <div class="max-w-clamp-1314px mx-auto">
            <?php if ($title) : ?>
            <div class="title text-40px md:text-60px xl:text-80px leading-normal font-black text-image text-center">
                <?= $title ?></div>
            <?php endif; ?>
        </div>
        <?php if ($description) : ?>
        <div class="description mt-5 text-18px font-normal text-neutral-900 text-center max-w-clamp-1165px mx-auto">
            <?= $description ?></div>
        <?php endif; ?>
        <?php if ($download_file) : ?>
        <a class="download-catalogue flex flex-col justify-center items-center text-primary-800 text-18px font-bold gap-1 image-svg xl:mt-10 mt-8"
            href="<?= is_array($download_file) ? $download_file['url'] : $download_file ?>" target="_blank">
            <img class="lozad" data-src="<?php bloginfo("template_directory"); ?>/img/home/download.svg">
            <?= $download_text ?>
        </a>
        <?php endif; ?>
    </div>
</section>