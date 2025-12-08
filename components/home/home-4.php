<?php
// File: components/home/home-4.php
// Section: Chứng nhận chất lượng
global $post;

$fields = get_field('group_4', $post->ID);
$title = $fields['title'] ?? '';
$items = $fields['items'] ?? [];
$button = $fields['button'] ?? '';
?>
<section class="home-4 section xl:pt-20 pb-0" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
        <?php if ($title) : ?>
        <h2 class="block-title text-center"><?= $title ?></h2>
        <?php endif; ?>
        <?php if ($items) : ?>
        <div class="row mt-10 2xl:mt-16 justify-center">
            <?php foreach ($items as $item) : ?>
            <?php
                    $item_image = $item['item_image'] ?? '';
                    $item_title = $item['item_title'] ?? '';
                    $item_description = $item['item_description'] ?? '';
                    ?>
            <div class="col-lg-4 col-sm-6">
                <div class="item">
                    <?php if ($item_image) : ?>
                    <div class="img max-w-clamp-120px mx-auto w-full">
                        <a href="javascript:;"><?= get_image_attrachment($item_image, 'image') ?></a>
                    </div>
                    <?php endif; ?>
                    <?php if ($item_title) : ?>
                    <div class="title subheader-24 font-bold text-primary-5 mt-3 text-center"><?= $item_title ?></div>
                    <?php endif; ?>
                    <?php if ($item_description) : ?>
                    <div class="description mt-1 text-18px text-primary-5 text-center"><?= $item_description ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php if ($button && $button['url']) : ?>
        <div class="button">
            <a class="btn btn-primary mx-auto mt-8 xl:mt-10" href="<?= $button['url'] ?>">
                <?= $button['title'] ?: __('XEM THÊM', 'canhcamtheme') ?>
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>