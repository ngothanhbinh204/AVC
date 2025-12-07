<?php
/*
Template name: Template - Certify
*/
?>

<?php global $post;
$fields = get_field('group', $post);
$list = $fields['list'];
?>

<?php get_header(); ?>

<?php
get_template_part('./modules/banner/page-banner');
?>
<?php
$ancestor = get_ancestors($post->ID, 'page');
$level_2 = $ancestor[0];
$page_child = get_pages(array(
    'child_of' => $level_2,
    'sort_column' => 'menu_order',
));
$current_id = $post->ID;
?>
<?php if ($ancestor > 1) : ?>
    <?php if ($page_child) : ?>
        <section class="certify section xl:py-20">
            <div class="container">
                <h1 class="block-title text-center"><?= get_the_title($ancestor[0]) ?></h1>
                <div class="normal-nav xl:mt-10 mt-6">
                    <nav class="justify-center flex items-center">
                        <ul>
                            <?php foreach ($page_child as $value) : ?>
                                <?php $id = $value->ID; ?>
                                <li <?php if ($id === $current_id) : ?>class="active" <?php endif; ?>>
                                    <a href="<?= get_permalink($id) ?>">
                                        <?= get_the_title($id) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                </div>
                <?php $repeater = get_field('repeater', $current_id); ?>
                <?php if ($repeater) : ?>
                    <div class="list grid lg:grid-cols-2 gap-4 xl:gap-10 xl:mt-10 mt-6">
                        <?php foreach ($repeater as $value) : ?>
                            <div class="item flex xl:p-8 p-5 bg-neutral-50">
    <div class="img w-full">
       
        <a href="<?= esc_url($value['image']['url']); ?>" class="fancybox" data-fancybox="gallery" rel="nofollow">
            <?= custom_lozad_image($value['image']); ?>
        </a>
    </div>
    <div class="content w-full flex-1">
        <div class="title subheader-24 font-bold text-primary-800"><?= $value['title'] ?></div>
        <div class="description mt-3 text-18px text-neutral-900"><?= $value['description'] ?></div>
    </div>
</div>

                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>

<?php get_footer(); ?>