<?php $id = get_the_ID();
if ($args["id"])
    $id = $args["id"];
$post_categories = get_post_primary_category($id, 'category');
$primary_category = $post_categories['primary_category'];
?>



<div class="bn bn-big relative">
    <div class="img">
        <a href='<?= get_the_permalink($id); ?>' title="<?= get_the_title($id); ?>">
            <?= custom_get_post_thumbnail($id); ?>
        </a>
    </div>
    <div class="content absolute p-5 bottom-0 w-full left-0 z-3 pointer-events-none text-white">
        <?= edit_link_post($id) ?>
        <div class="info flex items-center">
            <time>
                <?= dateFormatOnLayout($id) ?>
            </time>
            <?php if ($primary_category->name) : ?>
                <div class="cate text-xs font-bold"><?= $primary_category->name ?></div>
            <?php endif; ?>
        </div>
        <a class="title body-16 sm:subheader-20 mt-3 font-bold text-shadow-custom" href='<?= get_the_permalink($id); ?>' title="<?= get_the_title($id); ?>">
            <?= get_the_title($id) ?>
        </a>
        <div class="link-arrow mt-3">
            <a href='<?= get_the_permalink($id); ?>' title="<?= get_the_title($id); ?>">
                <img class="lozad" data-src="<?php bloginfo("template_directory"); ?>/img/boxevent/arrow-white.svg" />
            </a>
        </div>
    </div>
</div>