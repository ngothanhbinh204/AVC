<?php
/*
Template name: Template - Trang tĩnh
*/
?>

<?php get_header(); ?>
<?php get_template_part('./modules/breadcrumb/breadcrumb'); ?>


<?php
global $post;
?>

<div class="hidden">
    <div class="count-view"><?= the_ID() ?></div>
</div>
<section class="newsdetail section">
    <div class="container">
        <div class="list grid grid-cols-12 gap-6 xl:gap-8">
            <div class="col-left col-span-full">
                <div class="article">
                    <div class="article-header">
                        <h1 class="title header-32">
                            <?= the_title() ?>
                        </h1>
                        <div class="infos mt-5">
                            <?= dateFormatOnLayout($post) ?>
                        </div>
                    </div>
                    <div class="article-body prose max-w-full">
                        <div class="full-content md:text-lg text-base font-normal leading-1.5 -tracking-0.36 text-neutral-900">
                            <?= the_content() ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>