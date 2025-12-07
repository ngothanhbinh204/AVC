<?php
$terms = get_queried_object();
$id_category = $terms->term_id;
$taxonomy = $terms->taxonomy;
if ($id_category) {
    $id = $taxonomy . '_' . $id_category;
} else {
    $id = get_the_ID();
}
$banners = get_field('banner_select_page', $id);
$current_page_ID = get_the_ID();
$is_page = is_page();
?>


<?php if (!$banners[0]) : ?>
    <?= get_template_part('./modules/breadcrumb/breadcrumb'); ?>
<?php else : ?>
    <div class="overflow-hidden relative" id="page-banner">
        <?php if ($banners[0]) : ?>
            <div class="img">
                <a href="javascript:;" rel="nofollow">
                    <?= custom_get_post_thumbnail($banners[0]) ?>
                </a>
            </div>
            <div class="container absolute left-1/2 -translate-x-1/2 bottom-2 xl:bottom-10 z-2">
                <div class="wrapper">
                    <h2 class="title text-22px md:text-40px lg:text-54px text-white font-bold mb-3 lg:mb-5"><?= get_the_title($banners[0]) ?></h2>
                    <?= get_template_part('/modules/breadcrumb/breadcrumb') ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>