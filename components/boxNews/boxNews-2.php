<?php $id = get_the_ID();
if ($args["id"])
    $id = $args["id"];
// $post_categories = get_post_primary_category($id, 'category');
// $primary_category = $post_categories['primary_category'];
?>

<div class="bn bn-2">
    <div class="img">
        <a href='<?= get_the_permalink($id); ?>' title="<?= get_the_title($id); ?>">
            <?= custom_get_post_thumbnail($id); ?>
        </a>
    </div>
    <div class="content flex flex-col gap-4">
        <a class="title font-bold font-Montserrat xl:subheader-24 subheader-20 uppercase text-primary-1000" href='<?= get_the_permalink($id); ?>' title="<?= get_the_title($id); ?>">
            <span class="line-clamp-2">
                <?= get_the_title($od) ?>
            </span>
        </a>
        <div class="ctn body-16 md:body-18"><span class="line-clamp-3"><?= get_the_excerpt($id) ?></span></div>
        <?= get_template_part('/components/UI/button', '', array(
            'href' => get_permalink($id)
        )) ?>
    </div>
</div>