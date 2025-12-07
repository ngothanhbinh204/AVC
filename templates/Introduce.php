<?php
/*
Template name: Template - Introduce
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
<?php $nav = get_field('nav', $post); ?>
<?php if ($nav) : ?>
    <section class="introduce-nav spy-nav-menu border-b border-neutral-100 bg-white sticky z-10 -top--header-height overflow-hidden">
        <div data-aos="fade-up">
            <div class="container">
                <nav class="flex justify-center items-center relative">
                    <ul class="flex items-center xl:gap-10 gap-6">
                        <?php foreach ($nav as $key => $value) : ?>
                            <li><a class="text-18px font-normal text-[#545454] transition-all relative py-3 block" href="#section-<?= $key + 1 ?>">
                                    <?= $value['title'] ?>
                                </a></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="lavalamp absolute bottom-0 bg-primary-800 h-1px transition-all duration-700 xl:block hidden">
                    </div>
                </nav>
            </div>
        </div>
    </section>
<?php endif; ?>

<?=

get_template_part('/components/introduce/introduce-1');
get_template_part('/components/introduce/introduce-2');
get_template_part('/components/introduce/introduce-3');
get_template_part('/components/introduce/introduce-4');
get_template_part('/components/introduce/introduce-5');
?>

<?php get_footer(); ?>