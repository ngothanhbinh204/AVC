<?php
global $post;
$fields = get_field('group_4', $post);
?>
<section class="introduce-4 section xl:pt-20 pb-0" id="section-4">
    <div class="container">
        <div data-aos="fade-up">
            <h2 class="block-title text-center"><?= $fields['title'] ?></h2>
            <div class="sub-title subheader-24 font-bold text-black mt-3 text-center"><?= $fields['description'] ?></div>
            <?php $repeater = $fields['repeater']; ?>
            <?php if ($repeater) : ?>
                <div class="flex items-center justify-center gap-x-3 xl:gap-x-[calc(160/1400*100%)] mt-3 flex-wrap gap-y-4">
                    <?php foreach ($repeater as $value) : ?>
                        <div class="item flex flex-col items-center">
                            <div class="title text-18px font-normal">
                                <?= $value['title'] ?></div>
                            <div class="value flex items-baseline gap-3 mt-3">
                                <div class="number counter block-title font-black text-primary-800" data-count="<?= $value['number'] ?>">0</div>
                                <div class="unit subheader-20 font-bold text-primary-800"><?= $value['unit'] ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php if ($fields['background']) : ?>
        <div class="image mt-8">
            <div data-aos="zoom-in-down" data-aos-delay=300 data-aos-easing="ease-in-sine">
                <a href="javascript:;" rel="nofollow">
                    <?= custom_lozad_image($fields['background']) ?>
                </a>
            </div>
        </div>
    <?php endif; ?>
</section>