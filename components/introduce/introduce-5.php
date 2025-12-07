<?php
global $post;
$fields = get_field('group_5', $post);
?>
<section class="introduce-5 section pt-0 xl:pb-20" id="section-5">
    <?= get_template_part('/components/home/home-4', null, array(
        'fields' => $fields,
    )) ?>
</section>