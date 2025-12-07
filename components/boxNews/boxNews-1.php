<?php $id = get_the_ID();
if ($args["id"])
    $id = $args["id"];
$post_categories = get_post_primary_category($id, 'category');
$primary_category = $post_categories['primary_category'];
$wrapTag = $args['wrapTag'] ?? 'span';
?>

<div class="bn-1 h-full flex flex-col transition-all">
    <div class="img">
        <a href='<?= get_the_permalink($id); ?>' title="<?= get_the_title($id); ?>">
            <?= custom_get_post_thumbnail($id); ?>
        </a>
    </div>
    <div class="content pt-5 px-2 sm:px-5 pb-3 flex-1 flex flex-col">
        <a class="block title text-16px sm:subheader-24 font-bold text-black flex-1 transition-all" href='<?= get_the_permalink($id); ?>' title="<?= get_the_title($id); ?>">
            <span class="line-clamp-4">
                <<?= $wrapTag ?>>
                    <?= get_the_title($id) ?>
                </<?= $wrapTag ?>>
            </span>
        </a>
        <time class="text-18px text-neutral-500-main block mt-10">
            <?= dateFormatOnLayout($id) ?>
            <?= edit_link_post($id) ?>
        </time>
    </div>
</div>