<?php
/*
Template name: Template - Home
*/
?>

<!-- $GLOBALS['CANHCAM']['bg_body'] = 'fullpage'; -->

<?php get_header(); ?>

<div class="hidden">
    <h1><?= get_bloginfo('name') ?></h1>
</div>

<?=
get_template_part('./components/home/home-1');
get_template_part('./components/home/home-2');
get_template_part('./components/home/home-3');
get_template_part('./components/home/home-4');
get_template_part('./components/home/home-5');
get_template_part('./components/home/home-6');
get_template_part('./components/home/home-7');
?>
<?php get_footer(); ?>