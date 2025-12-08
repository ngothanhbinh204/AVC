<?php
// File: components/home/home-2.php
// Section: Hành trình cuộc sống xanh
global $post;

$fields = get_field('group_2', $post->ID);
$big_title = $fields['title'] ?? '';
$description = $fields['sub_title'] ?? '';
$content = $fields['description'] ?? '';
$button = $fields['url'] ?? '';
$background = $fields['background'] ?? '';
?>
<section class="home-2 section pb-0 relative z-2 pt-4 lg:pt-12" data-aos="fade-up">
    <div class="container relative z-2">
        <?php if ($big_title) : ?>
        <div class="big-title text-45px md:text-60px xl:text-96px font-black leading-normal text-center text-image">
            <?= $big_title ?></div>
        <?php endif; ?>
        <?php if ($description) : ?>
        <div class="description subheader-24 font-bold text-neutral-900 text-center mt-4 xl:mt-10"><?= $description ?>
        </div>
        <?php endif; ?>
        <?php if ($content) : ?>
        <div class="content text-18px text-neutral-900 text-center mt-3"><?= $content ?></div>
        <?php endif; ?>
        <?php if ($button && $button['url']) : ?>
        <div class="button">
            <a class="btn btn-primary mx-auto xl:mt-10 mt-8" href="<?= $button['url'] ?>">
                <?= $button['title'] ?: __('Tìm hiểu thêm', 'canhcamtheme') ?>
            </a>
        </div>
        <?php endif; ?>
    </div>
    <?php if ($background) : ?>
    <div class="background">
        <a href="javascript:;"><?= custom_lozad_image($background) ?></a>
    </div>
    <?php endif; ?>
</section>