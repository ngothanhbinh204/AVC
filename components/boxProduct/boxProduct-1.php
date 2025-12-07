<?php $id = get_the_ID();
if ($args["id"])
    $id = $args["id"];
?>

<div class="bpd-1 space-y-3 lg:space-y-6 zoom-img">
    <div class="img">
        <a href='<?= get_the_permalink($id); ?>' title="<?= get_the_title($id); ?>">
            <?= custom_get_post_thumbnail($id); ?>
        </a>
    </div>
    <a class="title block text-16px sm:subheader-24 font-bold transition-all" href="<?= get_permalink($id) ?>" title="<?= get_the_title($id); ?>">
        <?= get_the_title($id) ?>
    </a>
    <?= edit_link_post($id) ?>
</div>