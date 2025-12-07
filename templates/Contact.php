<?php
/*
Template name: Template - Liên hệ
*/
?>
<?php $GLOBALS['CANHCAM']['bg_body'] = 'bg-primary-50'; ?>
<?php get_header(); ?>



<?php
get_template_part('./modules/breadcrumb/breadcrumb');
?>


<?php global $post;
$col_left = get_field('col_left', $post);
$col_right = get_field('col_right', $post);
?>
<section class="contact section xl:py-20">
    <div class="container">
        <div class="grid grid-cols-12 xl:gap-10 gap-6">
            <div class="col-left col-span-full lg:col-span-5">
                <div class="wrapper lg:max-w-clamp-480px">
                    <h1 class="title block-title font-bold text-md"><?= $col_left['title'] ?></h1>
                    <?php $infos = $col_left['infos']; ?>
                    <?php if ($infos) : ?>
                        <div class="infos space-y-4 mt-5">
                            <?php foreach ($infos as $value) : ?>
                                <div class="item flex items-baseline gap-2">
                                    <div class="icon w-6 text-center"><?= $value['icon'] ?></div>
                                    <div class="ctn flex-1 w-full">
                                        <?= $value['content'] ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($col_left['map']) : ?>
                        <div class="map mt-30px"><?= $col_left['map'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-right col-span-full lg:col-span-7">
                <div class="wrapper py-8 px-3 lg:p-10 bg-neutral-50 rounded-tl-16 rounded-br-16">
                    <div class="description text-18px text-neutral-900 text-center"><?= $col_right['description'] ?></div>
                    <?php $form_shortcode = $col_right['form_shortcode']; ?>
                    <?php if ($form_shortcode) : ?>
                        <?= do_shortcode($form_shortcode) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>