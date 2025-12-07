<?php
global $post;
$fields = get_field('group_3', $post);
?>
<?php $repeater = $fields['repeater']; ?>
<?php if ($repeater) : ?>
    <section class="introduce-3 section xl:pt-20 pb-0" id="section-3">
        <div class="container">
            <div class="grid lg:items-end sm:grid-cols-2 lg:grid-cols-3">
                <?php $key = 0; ?>
                <?php foreach ($repeater as $value) : ?>
                    <?php $key++; ?>
                    <div class="item p-3 lg:p-8" data-aos='fade-up' data-aos-delay="<?= $key++ ?>00">
                        <div class="wrapper space-y-5">
                            <div class="icon max-w-clamp-64px">
                                <a href="javascript:;" rel="nofollow"><?= custom_lozad_image($value['logo']) ?></a>
                            </div>
                            <div class="title subheader-20 lg:header-48"><?= $value['title'] ?></div>
                            <div class="description text-18px space-y-6"><?= $value['description'] ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

<?php endif; ?>